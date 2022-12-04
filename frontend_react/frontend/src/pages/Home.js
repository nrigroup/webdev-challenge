import { useState } from 'react';

const REQUIRED_NUM_OF_HEADERS = 8;
const REQUIRED_HEADERS = [
    'date',
    'category',
    'lot title',
    'lot location',
    'lot condition',
    'pre-tax amount',
];
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

// Converts data content of csv file as string to an array. Returns an
// array of objects where each object represents a row.
// if successful an array is returned, otherwise undefined is returned
function csvStringToArray(str, delimiter = ',') {
    if (str.length === 0) {
        return undefined;
    }

    let arr;
    // slice from start of text to the first \n index
    // use split to create an array from string by delimiter
    const headers = str.slice(0, str.indexOf('\n')).split(delimiter);
    if (headers === '') {
        return undefined;
    }

    // slice from \n index + 1 to the end of the text
    // use split to create an array of each csv value row
    const rows = str.slice(str.indexOf('\n') + 1).split('\n');
    if (rows === '') {
        return undefined;
    }

    return arr;
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
// Returns an error message string if data violates the rules for csv files,
// Returns empty string, if all rules followed
export function findRuleViolation(csvString) {
    // Array of strings, where each string is a header name
    let csvHeaders = csvString.slice(0, csvString.indexOf('\n')).split(',');

    // Data is invalid, if minimum headers are not present
    if (csvHeaders.length < REQUIRED_NUM_OF_HEADERS) {
        return 'Minimum headers not present';
    }

    // if csv headers dont have a name, give them names explicitly
    if (csvHeaders[0] === '') {
        csvHeaders = [
            'date',
            'category',
            'lot title',
            'lot location',
            'lot condition',
            'pre-tax amount',
            'tax name',
            'tax amount',
        ];
    }

    // Array of strings, where each string represent a row
    let csvRows = csvString.slice(csvString.indexOf('\n') + 1).split('\n');
    csvRows = csvRows.slice(0, -1); // Remove last row as it is empty always due to \n
    // Data is invalid, if there are no rows
    if (csvRows.length < 1) {
        return 'Empty Rows';
    }

    // Map each row to csv headers
    for (let i = 0; i < csvRows.length; i += 1) {
        const entries = csvRows[i].split(',');
        for (let j = 0; j < entries.length; j += 1) {
            const entry = entries[j];
            const correspondingHeader = csvHeaders[j];
            // Data is invalid if entry does not exist for required header
            if (
                entry === '' &&
                findElementInArray(correspondingHeader, REQUIRED_HEADERS)
            ) {
                return 'Some required fields are missing';
            }
        }
    }

    return '';
}
function Home() {
    // State for maintaining error
    const [error, setError] = useState('');
    const handleFormSubmit = (e) => {
        e.preventDefault();

        if (!e.target.checkValidity()) {
            e.stopPropagation();
        }
    };
    const handleFileValidity = async (e) => {
        // Add was validated class to parent form,so that UI starts displaying feedback
        e.target.parentElement.classList.add('was-validated');

        // Check if file extension is csv or not
        if (!checkFileExtension(e.target.files[0].name, /\.(csv)$/i)) {
            // Set error message inside textContent of error
            setError('Not a csvs file');
            // Set validity of this element to false so that form becomes invalid
            e.target.setCustomValidity('Error');

            return;
        }

        const csvString = await fileToString(e.target.files[0]);
        if (csvString === '') {
            // Set error message inside textContent of error
            setError('Empty file');
            // Set validity of this element to false so that form becomes invalid
            e.target.setCustomValidity('Error');

            return;
        }
        // Check if data is valid or not
        const ruleError = findRuleViolation(csvString);
        if (!(ruleError === '')) {
            // If there is an error in CSV data
            setError(ruleError);
            // Set validity of this element to false so that form becomes invalid
            e.target.setCustomValidity('Error');
            return;
        }

        e.target.setCustomValidity('');
    };
    return (
        <div className="bg-light text-dark p-5 text-center">
            <form
                className="needs-validation"
                id="uploadForm"
                noValidate
                onSubmit={handleFormSubmit}
            >
                <input
                    className="form-control mx-auto form-fileInput"
                    type="file"
                    onChange={handleFileValidity}
                    required
                />
                <div className="invalid-feedback">{error}</div>

                <button type="submit" className="btn btn-primary my-3">
                    Upload
                </button>
            </form>
        </div>
    );
}

export default Home;
