import { useEffect, useState } from 'react';
import BarChart from '../components/BarChart';
import { useData } from '../contexts/DataContext';

const CSV_INT_BASE = 10;
// Gets all the unique fields in the data array based on the field type requested
export function getUniqueFields(dataArray, fieldType) {
    const uniqueFields = new Set([]);
    dataArray.forEach((row) => {
        const field = row[fieldType];
        uniqueFields.add(field);
    });
    return Array.from(uniqueFields);
}

// Returns the total pre-tax amount based on the queryType and query for that queryType
// Eg: Get total pre tax amount for 'category' 'Construction'. Here query is 'Construction' and queryType is 'category'
export function getAmountPerType(dataArray, query, queryType) {
    let totalAmount = 0;
    dataArray.forEach((element) => {
        if (element[queryType] === query) {
            totalAmount += parseInt(element['pre-tax amount'], CSV_INT_BASE);
        }
    });

    return totalAmount;
}

// Returns the total pre-tax amount in the data for particular date
// THis function assumes date exists for each element in dataArray
export function getAmountForDate(date, dataArray) {
    let totalAmount = 0;
    dataArray.forEach((element) => {
        if (element.date === date) {
            totalAmount += parseInt(element['pre-tax amount'], 10);
        }
    });

    return totalAmount;
}

function mapTwoArrays(array1, array2) {
    const result = {};
    array1.forEach((element, i) => {
        result[element] = array2[i];
    });
    return result;
}
function Analytics() {
    const { data } = useData();
    const [dates, setDates] = useState();
    const [amountsPerDate, setAmountsPerDate] = useState();
    const [categories, setCategories] = useState();
    useEffect(() => {
        if (data !== undefined) {
            // const uniqueDates = getUniqueDates(data);
            const uniqueDates = getUniqueFields(data, 'date');
            const uniqueCategories = getUniqueFields(data, 'category');
            const amountPerDate = uniqueDates.map((date) => {
                const amount = getAmountPerType(data, date, 'date');
                return amount;
            });

            const amountPerCategory = uniqueCategories.map((category) => {
                const amount = getAmountPerType(data, category, 'category');
                return amount;
            });

            setDates(uniqueDates);
            setAmountsPerDate(amountPerDate);
        }
    }, [data]);
    return (
        <div className="container">
            <div className="row">
                <div className="col w-25">
                    <BarChart labels={dates} datasets={amountsPerDate} />;
                </div>
            </div>
            <div className="row">
                <div className="col w-25">
                    <BarChart labels={dates} datasets={amountsPerDate} />;
                </div>
            </div>
        </div>
    );
}

export default Analytics;
