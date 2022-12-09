import { createContext, useContext, useMemo, useState } from 'react';

const FAIL_RESPONSE_CODE = 400;
const SUCCESS_RESPONSE_CODE = 200;

const DataContext = createContext();
const BACKEND_API_URL = 'http://localhost:8000/api/';

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
        if (!jsonData) return FAIL_RESPONSE_CODE;

        try {
            fetch(BACKEND_API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify([
                    {
                        date: '09/22/2013',
                        category: 'Construction',
                        'lot title': 'Hauling Transfer Trailers',
                        'lot location': '"783 Park Ave, New York, NY 10021"',
                        'lot condition': 'Brand New',
                        'pre-tax amount': '2.3',
                        'tax name': '',
                        'tax amount': '',
                    },
                ]),
            })
                .then((response) => response.json())
                .then((responseData) => {
                    console.log(responseData);
                    // Here code for setting data state can be written if display
                    // of data from database is desired.
                })
                .catch((err) => {
                    console.log(err);
                });
        } catch (err) {
            return FAIL_RESPONSE_CODE;
        }
        setData(jsonData);
        return SUCCESS_RESPONSE_CODE;
    }
    const providerValues = useMemo(() => ({ data, uploadData }), [data]);
    return (
        <DataContext.Provider value={providerValues}>
            {children}
        </DataContext.Provider>
    );
}
