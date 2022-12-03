import { useState } from 'react';

// dataContext: Provides the data along with the functionality to validate data
export function DataProvider({ children }) {
    const [data, updateData] = useState();
}
