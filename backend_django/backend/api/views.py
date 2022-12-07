from django.shortcuts import render, HttpResponse
from django.http import JsonResponse
from django.views.decorators.csrf import csrf_exempt
from http import HTTPStatus
import traceback
import logging
import json
# Create your views here.


@csrf_exempt
def index(request):
    print(request)
    if request.method == "POST":

        try:
            receivedDataInJson = request.body.decode(
                "ASCII")  # Because its a byte string
            dataInDict = json.loads(receivedDataInJson)

        except Exception as e:
            logging.error(traceback.format_exc())
            return JsonResponse({'data': 'success'}, status=HTTPStatus.BAD_REQUEST)
    return JsonResponse({'data': 'failed'}, status=HTTPStatus.BAD_REQUEST)
