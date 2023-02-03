/*
* inbuilt / framework imports
* */
import React, { lazy, Suspense } from 'react'
import ReactDOM from 'react-dom/client'
import { BrowserRouter, Route, Link, Routes } from "react-router-dom";

/*
* Pages Import
* */
const Dashboard = lazy(() => import("./pages/Dashboard.jsx"))
const DataTable = lazy(() => import("./pages/DataTable.jsx"))

/*
* Navigation Components
* */
const Navigation = lazy(() => import("./components/Navigation"));
import {SideBar as SideNavigation} from "./components/Navigation.jsx";

/*
* Loading Components
* */

import Loading from "./pages/loading.jsx";

/*
* importing css
* */
import './assets/styles/index.scss'

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <BrowserRouter>
      {/*Import commons*/}
      <SideNavigation />
      <Suspense fallback={<Loading/>}>
        <Routes>
          <Route index element={<Dashboard />} />
          <Route path={"/"} element={<Dashboard />} />
          <Route path={"/loading"} element={<Loading />} />
          <Route path={"/data"} element={<DataTable />} />
        </Routes>
      </Suspense>
    </BrowserRouter>
  </React.StrictMode>,
)
