export const TAX_FIELD_NAME = 'pre-tax amount';
export const DATE_FIELD_NAME = 'date';
export const CATEGORY_FIELD_NAME = 'category';
export const LOT_CONDITION_FIELD_NAME = 'lot condition';
export const SUCCESS_CODE = 200;

export const REQUIRED_HEADERS = [
    'date',
    'category',
    'lot title',
    'lot location',
    'lot condition',
    'pre-tax amount',
];

export const ALL_HEADERS = [
    'date',
    'category',
    'lot title',
    'lot location',
    'lot condition',
    'pre-tax amount',
    'tax name',
    'tax amount',
];

export const REQUIRED_NUM_OF_HEADERS = 8;

export const CSV_SPLIT_PATTERN = /,(?=(?:(?:[^"]*"){2})*[^"]*$)/;
export const BACKEND_API_URL = 'https://csvreader-backend.herokuapp.com/api/';
export const FAIL_RESPONSE_CODE = 400;
export const SUCCESS_RESPONSE_CODE = 200;
