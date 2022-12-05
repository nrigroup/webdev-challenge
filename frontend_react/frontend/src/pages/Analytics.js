import { useEffect, useState } from 'react';
import BarChart from '../components/BarChart';
import { useData } from '../contexts/DataContext';

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
    const [amounts, setAmounts] = useState();

    const [bargraphData, setBargraphData] = useState();
    useEffect(() => {
        if (data !== undefined) {
            const uniqueDates = getUniqueDates(data);
            const amountForDates = uniqueDates.map((date) => {
                const amount = getAmountForDate(date, data);
                return amount;
            });
            // Map dates to amounts
            const datesToAmount = mapTwoArrays(uniqueDates, amountForDates);
            console.log(datesToAmount);
            setBargraphData(datesToAmount);
            setDates(uniqueDates);
            setAmounts(amountForDates);
        }
    }, [data]);
    return (
        <div className="container">
            <div className="row">
                <div className="col w-25">
                    <BarChart labels={dates} datasets={amounts} />;
                </div>
            </div>
        </div>
    );
}

export default Analytics;
