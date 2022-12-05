import { getUniqueDates } from './Analytics';

test('Returns length 1 for an array with two dates which are same', () => {
    expect(
        getUniqueDates([
            { date: '12/1/2013', category: 'Construction' },
            { date: '12/1/2013', category: 'Construction' },
        ]).length
    ).toBe(1);
});

test('Returns length 2 for an array with two dates which are same', () => {
    expect(
        getUniqueDates([
            { date: '12/1/2013', category: 'Construction' },
            { date: '12/2/2013', category: 'Construction' },
        ]).length
    ).toBe(2);
});
