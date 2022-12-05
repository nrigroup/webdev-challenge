import { useState } from 'react';

import {
    fileToString,
    checkFileExtension,
    findRuleViolation,
    findElementInArray,
} from '../utils';

function checkFileValidity(file) {
    if (!checkFileExtension(file, /\.(csv)$/i)) {
        return false;
    }

    return true;
}
// dataContext: Provides the data along with the functionality to validate data
export function DataProvider({ children }) {
    const [data, updateData] = useState();
}
