// PARSING THE FILES //

$('#files').parse({
    config: {
        delimiter: "auto",
        complete: displayHTMLTable,
    },
    before: function (file, inputElem) {
        //console.log("Parsing file...", file);
    },
    error: function (err, file) {
        //console.log("ERROR:", err, file);
    },
    complete: function () {
        //console.log("Done with all files");
    }
});

// FUNCTION DISPLAY THE TABLE RESULTS //

function displayHTMLTable(results) {
    var table = "<table class='table'>";
    var data = results.data;

    for (i = 0; i < data.length; i++) {
        table += "<tr>";
        var row = data[i];
        var cells = row.join(",").split(",");

        for (j = 0; j < cells.length; j++) {
            table += "<td>";
            table += cells[j];
            table += "</th>";
        }
        table += "</tr>";
    }
    table += "</table>";
    $("#parsed_csv_list").html(table);
}

