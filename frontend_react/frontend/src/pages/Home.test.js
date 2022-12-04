import {
    findElementInArray,
    checkFileExtension,
    findRuleViolation,
} from './Home';

test('Returns true if an element exist in array', () => {
    expect(findElementInArray(1, [1, 2, 3])).toBe(true);
});

test('Returns false if an element does not exist in array', () => {
    expect(findElementInArray(0, [1, 2, 3])).toBe(false);
});

test('Returns true if filename matches pattern for csv extension', () => {
    expect(checkFileExtension('data.csv', '/.(csv)$/i')).toBe(false);
});

test('Returns header error if required number of headers are not there', () => {
    expect(
        findRuleViolation(
            'date,category,lot title,lot location,lot condition,pre-tax amount,tax name\n'
        )
    ).toBe('Minimum headers not present');
});

test('Returns empty rows error if there are no rows', () => {
    expect(
        findRuleViolation(
            'date,category,lot title,lot location,lot condition,pre-tax amount,tax name,tax amount\n'
        )
    ).toBe('Empty Rows');
});

test('Returns required field error if required fields are missing', () => {
    expect(
        findRuleViolation(
            'date,category,lot title,lot location,lot condition,pre-tax amount,tax name,tax amount\n12/1/2013,,Hauling Transfer Trailers,"783 Park Ave, New York, NY 10021",Brand New,350,NY Sales tax,31.06\n'
        )
    ).toBe('Some required fields are missing');
});
test('Returns empty string if all rules are followed in the csv data', () => {
    expect(
        findRuleViolation(
            'date,category,lot title,lot location,lot condition,pre-tax amount,tax name,tax amount\n12/1/2013,Construction,Hauling Transfer Trailers,"783 Park Ave, New York, NY 10021",Brand New,350,NY Sales tax,31.06\n'
        )
    ).toBe('');
});

test('Returns empty string if all only non required fields are absent', () => {
    expect(
        findRuleViolation(
            'date,category,lot title,lot location,lot condition,pre-tax amount,tax name,tax amount\n12/1/2013,Construction,Hauling Transfer Trailers,"783 Park Ave, New York, NY 10021",Brand New,350,NY Sales tax,\n'
        )
    ).toBe('');
});
