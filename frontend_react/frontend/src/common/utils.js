import * as constants from './common_names';

export function checkFileExtension(filename, pattern) {
    let validity = true;
    // Check file format
    if (!filename.match(pattern)) {
        validity = false;
        return validity;
    }

    return validity;
}

// Returns a string of data in the file object. Empty string if any error
export async function fileToString(file) {
    if (!file) {
        return '';
    }

    const str = await file.text();

    if (str === undefined) {
        return '';
    }

    return str;
}

// Returns true if element exist in array
export function findElementInArray(element, arr) {
    for (let i = 0; i < arr.length; i += 1) {
        if (arr[i] === element) {
            return true;
        }
    }
    return false;
}

// Gets all the unique fields in the data array based on the field type requested
export function getUniqueFields(dataArray, fieldType) {
    const uniqueFields = new Set([]);
    dataArray.forEach((row) => {
        const field = row[fieldType];
        uniqueFields.add(field);
    });
    return Array.from(uniqueFields);
}

// Returns an array of objects where each object represents a row with header matched with each element
// Assumes each number of headers match with number of elements in each row
// Returns an empty array if there is an empty column in a row for a required header
export function mapHeadersToRows(headers, rows, requiredHeaders = undefined) {
    const finalArray = [];

    if (headers.length === 0) {
        return [];
    }

    if (rows.length === 0) {
        return [];
    }

    if (headers.length !== rows[0].length) {
        return [];
    }

    for (let i = 0; i < rows.length; i += 1) {
        const row = rows[i];
        const mappedRow = {};
        for (let j = 0; j < headers.length; j += 1) {
            const rowEntry = row[j];
            const correspondingHeader = headers[j];
            // Data is invalid if entry does not exist for required header
            if (
                rowEntry === '' &&
                findElementInArray(correspondingHeader, requiredHeaders)
            ) {
                return [];
            }

            mappedRow[`${correspondingHeader}`] = rowEntry;
        }
        finalArray.push(mappedRow);
    }

    return finalArray;
}

// Returns an array of csvHeaders which is the first row in csvString
export function getCsvHeaders(csvString) {
    if (csvString === '') {
        return [];
    }

    let csvHeaders = [];
    try {
        // Array of strings, where each string is a header name
        csvHeaders = csvString
            .slice(0, csvString.indexOf('\n'))
            .split(constants.CSV_SPLIT_PATTERN);
    } catch (err) {
        return [];
    }
    return csvHeaders;
}

export function getCsvRows(csvString) {
    if (csvString === '') {
        return [];
    }

    // Array of strings, where each string represent a row
    let csvRows = [];
    try {
        csvRows = csvString.slice(csvString.indexOf('\n') + 1).split('\n');
        csvRows = csvRows.slice(0, -1); // Remove last row as it is empty always due to \n
        csvRows = csvRows.map((row) => row.split(constants.CSV_SPLIT_PATTERN)); // Split each row into elements
    } catch (err) {
        return [];
    }
    return csvRows;
}
