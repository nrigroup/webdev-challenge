import React from 'react';
import { Navigate, Outlet } from 'react-router-dom';
import { useData } from '../contexts/DataContext';

export default function PrivateRoute() {
    const { data } = useData();

    // Render the analytics page if data exists, otherwise navigate to home page
    return data ? <Outlet /> : <Navigate to="/" />;
}
