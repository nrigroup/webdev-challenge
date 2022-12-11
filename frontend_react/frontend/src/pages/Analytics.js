import { useEffect, useState } from 'react';
/* eslint-disable */
import { Chart as ChartJS } from 'chart.js/auto';
/* eslint-enable */
import BarChart from '../components/BarChart';
import PieChart from '../components/PieChart';
import { useData } from '../contexts/DataContext';
import * as constants from '../common/common_names';
import { getUniqueFields } from '../common/utils';

const CSV_INT_BASE = 10;

// Returns the total pre-tax amount based on the queryType and query for that queryType
// Eg: Get total pre tax amount for constants.CATEGORY_FIELD_NAME 'Construction'. Here query is 'Construction' and queryType is constants.CATEGORY_FIELD_NAME
export function getAmountPerQueryType(dataArray, query, queryType) {
    let totalAmount = 0;
    dataArray.forEach((element) => {
        if (element[queryType] === query) {
            totalAmount += parseInt(
                element[constants.TAX_FIELD_NAME],
                CSV_INT_BASE
            );
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
            totalAmount += parseInt(element[constants.TAX_FIELD_NAME], 10);
        }
    });

    return totalAmount;
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
            const uniqueDates = getUniqueFields(
                data,
                constants.DATE_FIELD_NAME
            );
            const amountPerDate = uniqueDates.map((date) => {
                const amount = getAmountPerQueryType(
                    data,
                    date,
                    constants.DATE_FIELD_NAME
                );
                return amount;
            });
            setDates(uniqueDates);
            setAmountsPerDate(amountPerDate);

            // Categories
            const uniqueCategories = getUniqueFields(
                data,
                constants.CATEGORY_FIELD_NAME
            );
            const amountPerCategory = uniqueCategories.map((category) => {
                const amount = getAmountPerQueryType(
                    data,
                    category,
                    constants.CATEGORY_FIELD_NAME
                );
                return amount;
            });
            setCategories(uniqueCategories);
            setAmountsPerCategory(amountPerCategory);

            // Conditions
            const uniqueConditions = getUniqueFields(
                data,
                constants.LOT_CONDITION_FIELD_NAME
            );
            const amountPerCondition = uniqueConditions.map((condition) => {
                const amount = getAmountPerQueryType(
                    data,
                    condition,
                    constants.LOT_CONDITION_FIELD_NAME
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
                <div className="col d-flex justify-content-center">
                    <BarChart
                        title="Pre-tax amount per category"
                        labels={dates}
                        datasets={amountsPerDate}
                    />
                </div>
            </div>

            <div className="row mt-5">
                <div className="col-sm col-md-6 d-flex justify-content-center">
                    <div className="chart-wrapper">
                        <PieChart
                            title="Pre-tax amount per category"
                            labels={categories}
                            datasets={amountsPerCategory}
                        />
                    </div>
                </div>
                <div className="col-md-6 col-sm d-flex justify-content-center">
                    <div className="chart-wrapper">
                        <PieChart
                            title="Pre-tax amount per condition"
                            labels={conditions}
                            datasets={amountsPerCondtion}
                        />
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Analytics;
