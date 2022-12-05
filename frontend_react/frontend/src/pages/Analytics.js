import { useEffect, useState } from 'react';
import BarChart from '../components/BarChart';
import { useData } from '../contexts/DataContext';

// Gets all the unique fields in the data array based on the field type requested
export function getUniqueFields(dataArray, fieldType) {
    const uniqueFields = new Set([]);
    dataArray.forEach((row) => {
        const field = row[fieldType];
        uniqueFields.add(field);
    });
    return Array.from(uniqueFields);
}

// Gets all the unique dates in the array of data
export function getUniqueDates(dataArray) {
    const uniqueDates = new Set([]);
    dataArray.forEach((row) => {
        const { date } = row;
        uniqueDates.add(date);
    });
    return Array.from(uniqueDates);
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
            console.log(uniqueDates);
            const uniqueCategories = getUniqueFields(data, 'category');
            console.log(uniqueCategories);
            const amountForDates = uniqueDates.map((date) => {
                const amount = getAmountForDate(date, data);
                return amount;
            });
            setDates(uniqueDates);
            setAmountsPerDate(amountForDates);
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
