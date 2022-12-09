import { createContext, useContext, useMemo, useState } from 'react';
import { BACKEND_API_URL, SUCCESS_RESPONSE_CODE } from '../common/common_names';

const DataContext = createContext();

// Custom Hook to use the context for authentication
export function useData() {
    return useContext(DataContext);
}
// dataContext: Provides the data along with the functionality to validate data
// eslint-disable-line no-use-before-define
export function DataProvider({ children }) {
    /* ***** State variables ********** */
    const [data, setData] = useState();

    // This function assumes data passed is json data
    // Returns the response received from server
    async function uploadData(jsonData) {
        if (!jsonData) return 0;

        try {
            await fetch(BACKEND_API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(jsonData),
            })
                .then((response) => response.status)
                .then((status) => {
                    if (status !== SUCCESS_RESPONSE_CODE) {
                        throw new Error('Failed to upload data in database');
                    }
                    // Here code for setting data state can be written if display
                    // of data from database is desired.
                })
                .catch((err) => {
                    throw err;
                });
        } catch (err) {
            return 0;
        }
        setData(jsonData);
        return 1;
    }
    const providerValues = useMemo(() => ({ data, uploadData }), [data]);
    return (
        <DataContext.Provider value={providerValues}>
            {children}
        </DataContext.Provider>
    );
}
