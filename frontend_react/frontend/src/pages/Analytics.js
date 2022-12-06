import { useEffect, useState } from 'react';
import BarChart from '../components/BarChart';
import PieChart from '../components/PieChart';
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
export function getAmountPerQueryType(dataArray, query, queryType) {
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
    // For amount per Dates
    const [dates, setDates] = useState();
    const [amountsPerDate, setAmountsPerDate] = useState();
    // For amount per Categories
    const [categories, setCategories] = useState();
    const [amountsPerCategory, setAmountsPerCategory] = useState();
    // For amount per condition
    const [conditions, setConditions] = useState();
    const [amountsPerCondtion, setAmountsPerCondition] = useState();

    useEffect(() => {
        if (data !== undefined) {
            // Dates
            const uniqueDates = getUniqueFields(data, 'date');
            const amountPerDate = uniqueDates.map((date) => {
                const amount = getAmountPerQueryType(data, date, 'date');
                return amount;
            });
            setDates(uniqueDates);
            setAmountsPerDate(amountPerDate);

            // Categories
            const uniqueCategories = getUniqueFields(data, 'category');
            const amountPerCategory = uniqueCategories.map((category) => {
                const amount = getAmountPerQueryType(
                    data,
                    category,
                    'category'
                );
                return amount;
            });
            setCategories(uniqueCategories);
            setAmountsPerCategory(amountPerCategory);

            // Conditions
            const uniqueConditions = getUniqueFields(data, 'lot condition');
            const amountPerCondition = uniqueConditions.map((condition) => {
                const amount = getAmountPerQueryType(
                    data,
                    condition,
                    'lot condition'
                );
                return amount;
            });
            setConditions(uniqueConditions);
            setAmountsPerCondition(amountPerCondition);
        }
    }, [data]);
    return (
        <div className="container">
            <div className="row">
                <div className="col w-25">
                    <BarChart
                        title="Pre-tax amount per category"
                        labels={dates}
                        datasets={amountsPerDate}
                    />
                </div>
            </div>

            <div className="row mt-5">
                <div className="col-6">
                    <PieChart
                        title="Pre-tax amount per category"
                        labels={categories}
                        datasets={amountsPerCategory}
                    />
                </div>
                <div className="col-6">
                    <PieChart
                        title="Pre-tax amount per condition"
                        labels={conditions}
                        datasets={amountsPerCondtion}
                    />
                </div>
            </div>
        </div>
    );
}

export default Analytics;
