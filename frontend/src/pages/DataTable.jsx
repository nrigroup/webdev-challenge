/*
* inbuilt / framework imports
* */
import React, {Suspense, lazy, useState, useEffect} from "react";

/*
* Loading Components
* */
import Navigation from "../components/Navigation.jsx";
import Loading from "./loading.jsx";

/*
* loading api connection classes
* */
import AuctionItemService from "../api/AuctionItemService.js";

const DataTable = () => {
  // creating instance of class to connect with api
  const auctionItemService = new AuctionItemService();

  const [Data, setData] = useState({
    Total: [],
    Filter: [],
  })

  useEffect(() => {
    // getting data form api server
    auctionItemService.GetData()
        .then((result) => {
          console.log(result);
          setData((prevState) => {
            return {
              Total: result,
              Filter: result
            }
          })
        })
  }, [Data.Total.length])

  return <Suspense fallback={<Loading />}>
    <div className={"main container"}>
      <Navigation
        Left={["searchBar"]}
        Right={["addData"]}

        data={Data.Total}
        filter={(data)=>setData({Total: Data.Total, Filter: data})}
      />

      <div id={"data"}>
        <table>
          <tr className={"heading"}>
            <th>Date</th>
            <th>Category</th>
            <th>Lot Title</th>
            <th>Lot Location</th>
            <th>Lot Condition</th>
            <th>Pre-Tax Amount</th>
            <th>Tax Name</th>
            <th>Tax Amount</th>
          </tr>

          <DataList filterdata={Data.Filter}/>
        </table>
      </div>
    </div>
  </Suspense>
}

const DataList = (props) => {
  let result = [];

  for (const Element of props.filterdata) {
    result.push(
        <tr key={Element.date+Element.category+Element.preTaxAmount}>
          <td>{Element.date}</td>
          <td>{Element.category}</td>
          <td>{Element.lotTitle}</td>
          <td>{Element.lotLocation}</td>
          <td>{Element.lotCondition}</td>
          <td>{Element.preTaxAmount}</td>
          <td>{Element.taxName}</td>
          <td>{Element.taxAmount}</td>
        </tr>
    )
  }

  return result;
}

export default DataTable;