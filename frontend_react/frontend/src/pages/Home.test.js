import {
    findElementInArray,
    checkFileExtension,
    getCsvHeaders,
    getCsvRows,
    mapHeadersToRows,
} from '../utils';

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
    const csvHeaders = getCsvHeaders(
        'date,category,lot title,lot location,lot condition,pre-tax amount,tax name,tax amount'
    );
    expect(csvHeaders.length).toBe(8);
});

test('Checks if two rows are returned for a valid csvString with 2 rows', () => {
    const csvRows = getCsvRows(
        'date,category,lot title,lot location,lot condition,pre-tax amount,tax name,tax amount\n12/1/2013,,Hauling Transfer Trailers,"783 Park Ave, New York, NY 10021",Brand New,350,NY Sales tax,31.06\n2/18/2014,Computer – Software,MS OFFICE 2016 Bulk,"1600 Amphitheatre Parkway, Mountain View, CA 94043",Brand New,1500,CA Sales tax,112.5\n'
    );
    expect(csvRows.length).toBe(2);
});

test('Checks if no rows are returned for a valid csvString with 0 rows', () => {
    const csvRows = getCsvRows(
        'date,category,lot title,lot location,lot condition,pre-tax amount,tax name,tax amount\n'
    );
    expect(csvRows.length).toBe(0);
});
test('Returns a valid mapping between a headers and rows if a vlid csvString with 2 rows is passed', () => {
    expect(
        JSON.stringify(
            mapHeadersToRows(
                getCsvHeaders('date,category\n12/1/2013,Construction\n'),
                getCsvRows('date,category\n12/1/2013,Construction\n'),
                ['date', 'category']
            )
        )
    ).toBe('[{"date":"12/1/2013","category":"Construction"}]');
});

test('Returns empty array for a valid csvString that has a missing required field', () => {
    expect(
        JSON.stringify(
            mapHeadersToRows(
                getCsvHeaders('date,category\n12/1/2013,Construction\n'),
                getCsvRows('date,category\n12/1/2013,\n'),
                ['date', 'category']
            )
        )
    ).toBe(JSON.stringify([]));
});
test('Returns valid array for a valid csvString that has a missing non-required field', () => {
    expect(
        JSON.stringify(
            mapHeadersToRows(
                getCsvHeaders('date,category\n12/1/2013,Construction\n'),
                getCsvRows('date,category\n12/1/2013,\n'),
                ['date']
            )
        )
    ).toBe('[{"date":"12/1/2013","category":""}]');
});
