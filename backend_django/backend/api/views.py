from django.shortcuts import render, HttpResponse
from django.http import JsonResponse
from django.views.decorators.csrf import csrf_exempt
from http import HTTPStatus
import traceback
import logging
import json
import os
from .models import DataEntry
import datetime

REQUIRED_FIELDS = [
    'date',
    'category',
    'lot title',
    'lot location',
    'lot condition',
    'pre-tax amount',
]
# Create your views here.


def checkRequiredFieldsPresent(dataEntries):
    """Checks if required fields are present in the data or not
    Arguments: Accept a list of data entries where each entry is a dict, Atlease one entry should be present
    Returns: 
        Boolean: True, if all fields are present. False, Otherwise
        """

    for entry in dataEntries:
        for required in REQUIRED_FIELDS:

            if required not in entry:
                return False
            if entry[required] == "":
                return False

    return True


def checkDataValues(dataEntries):
    """Checks if field values are in range and as per database model
    Arguments: Accept a list of data entries where each entry is a dict, Atleast one entry should be present
                Assumes data has been validated through required fields checks
    Returns: 
        Boolean: True, if all entries are valid, False otherwise
        """

    for entry in dataEntries:
        # Try to create a data object, if successful, data is valid, otherwise not
        try:
            dataEntryObject = DataEntry(date=entry["date"],
                                        category=entry['category'],
                                        lot_title=entry['lot title'],
                                        lot_location=entry['lot location'],
                                        lot_condition=entry['lot condition'],
                                        pre_tax_amount=entry['pre-tax amount'],
                                        )

        except Exception as e:
            logging.error(traceback.format_exc())
            return False

    return True


def validateData(dataEntries):
    """This function validates the data received from the frontend.
    Concretely, the data is validate for required data fields,
    The type for each field should be valid and in the range

    Returns:
        string: A validations message
    """
    # Validate required fields are not empty
    if(not checkRequiredFieldsPresent(dataEntries)):
        return "Invalid Data, required fields missing"

    # Validate type and range for each field values based on database model restrictions
    if(not checkDataValues(dataEntries)):
        return "Invalid type and range for some fields"

    return "valid"


def clearDatabase(ModelToDelete):
    """Deletes all entries in the databse
    Arguments:
        Model which needs to be deleted. Expects that model exists
    Returns:
        None
    """
    try:
        ModelToDelete.objects.all().delete()
    except Exception as e:
        raise e


def saveInDatabase(entry):
    """Create an entry in the database

    Args:
        entry (DataEntry): data entry to be saved

    Returns:
        None
    """
    try:
        entryModel = DataEntry(date=entry["date"],
                               category=entry['category'],
                               lot_title=entry['lot title'],
                               lot_location=entry['lot location'],
                               lot_condition=entry['lot condition'],
                               pre_tax_amount=entry['pre-tax amount'],
                               tax_name=entry['tax name'],
                               tax_amount=entry['tax amount']
                               )
        entryModel.save()
    except:
        raise Exception("Could not save in database")


def cleanData(data):
    for entry in data:
        if entry["tax amount"] == "":
            entry["tax amount"] = None
        # Change data format
        entry["date"] = datetime.datetime.strptime(
            entry["date"], "%m/%d/%Y").strftime("%Y-%m-%d")


@csrf_exempt
def index(request):

    if request.method == "POST":

        try:
            receivedDataString = request.body  # Because its a byte string
            listOfDataEntries = json.loads(receivedDataString)

            if listOfDataEntries == []:
                return JsonResponse({'message': 'Empty data'}, status=HTTPStatus.BAD_REQUEST)
            # Clean the data
            cleanedData = cleanData(listOfDataEntries)
            # Validate data
            validationResult = validateData(listOfDataEntries)

            if validationResult == 'valid':
                # Clear all previous data from database
                clearDatabase(DataEntry)

                # Save in Database
                for entry in listOfDataEntries:
                    # Save in database
                    saveInDatabase(entry)
                return JsonResponse({'message': 'Success'}, status=HTTPStatus.OK)

            return JsonResponse({'message': validationResult}, status=HTTPStatus.BAD_REQUEST)

        except Exception as e:
            logging.error(traceback.format_exc())
            return JsonResponse({'message': 'failed'}, status=HTTPStatus.BAD_REQUEST)
    return JsonResponse({'message': 'failed'}, status=HTTPStatus.BAD_REQUEST)
