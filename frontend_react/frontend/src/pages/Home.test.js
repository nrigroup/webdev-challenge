import { findElementInArray } from './Home';

test('Returns true if an element exist in array', () => {
    expect(findElementInArray(1, [1, 2, 3])).toBe(true);
});
