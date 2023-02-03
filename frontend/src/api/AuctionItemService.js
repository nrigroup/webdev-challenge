
export default class AuctionItemService {
    ServerLink = "http://0.0.0.0:9000/";
    async GetData() {
        try {
            const response = await fetch(this.ServerLink + "getData", {
                method: "GET",
                mode: "cors",
                headers: {
                    "Access-Control-Allow-Headers": "Origin, Accept, X-Request-With, Content-Type",
                    "Access-Control-Allow-Origin": "*",
                    "Content-Type": "application/json"
                }
            });
            const data = await response.json();
            return data;
        } catch (e) {
            return 0;
        }
    }

    async UploadData(csvContent) {
        let rows = csvContent.split("\n");
        let header = rows[0].replaceAll(" ", "_").split(',');
        rows.shift();

        // result variable for api request
        // if something went wrong it'll change in fetch to 0/false
        let result = 1;

        // looping around rows to get values
        for (const row of rows) {
            if (row !== "") {
                // creating temp object to store object of each row
                let tempObject = {};
                // splitting row by , and storing it in variable
                let current = row.split(/,(?=(?:(?:[^"]*"){2})*[^"]*$)/);

                let encodedDate = encodeURIComponent(current[header.indexOf("date")]);
                let encodedCategory = encodeURIComponent(current[header.indexOf("category")]);
                let encodedLotTitle = encodeURIComponent(current[header.indexOf("lot_title")])
                let encodedLotLocation = encodeURIComponent(current[header.indexOf("lot_location")].replaceAll("\"", ""));
                let encodedLotCondition = encodeURIComponent(current[header.indexOf("lot_condition")]);
                let encodedPreTaxAmount = current[header.indexOf("pre-tax_amount")];
                let encodedTaxName = encodeURIComponent(current[header.indexOf("tax_name")]);
                let encodedTaxAmount = encodeURIComponent(current[header.indexOf("tax_amount")]);
                
                // if encodedTaxObject is empty replace with 0
                // to prevent errors
                try {
                    encodedTaxAmount = parseFloat(encodedTaxAmount);
                } catch (e) {
                    encodedTaxAmount = 0;
                }

                // creating queries for link
                let queries = `date=${encodedDate}&category=${encodedCategory}&lot_title=${encodedLotTitle}&lot_condition=${encodedLotCondition}&lot_location=${encodedLotLocation}&pre_tax_amount=${encodedPreTaxAmount}&tax_name=${encodedTaxName}&tax_amount=${encodedTaxAmount}`;

                // creating and sending fetch request
                await fetch(this.ServerLink + "uploadData?" + queries, {
                    method: "GET",
                    mode: "cors",
                    headers: {
                        "Access-Control-Allow-Headers": "Origin, Accept, X-Request-With, Content-Type",
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json"
                    }
                })
                    .then((response) => {
                        // if we got response
                        if (response) {
                            if (response["status"]) {
                                // if fetch request status success
                            }
                        }
                        result = 0;
                    })
            }
        }

        return result;
    }
}