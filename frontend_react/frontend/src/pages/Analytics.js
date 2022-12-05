import { useEffect, useState } from 'react';
import { useData } from '../contexts/DataContext';

function Analytics() {
    const { data } = useData();

    return <div>{data}</div>;
}

export default Analytics;
