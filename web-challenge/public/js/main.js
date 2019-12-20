(function($){
    $(document).ready(function(){
        // Attach reload event to back button
        $('#return').click(function(){location.reload()});
        /** generateTable to convert response result to HTML table
         * @param {object} result - the result object recieved
         * @returns jQuery Element
         */
        function generateTable(result){
            var table = "<table>";
            var month_array = {1: "Jan" , 2: "Feb", 3: "Mar", 4: "Apr", 5: "May", 6: "Jun", 7: "Jul" , 8: "Aug", 9: "Sep", 10: "Oct", 11: "Nov", 12: "Dec"}
            var cat_array = []

            //Populate cat_array with data grouped by category
            for(var month in result.moncat){
                for(var monData in result.moncat[month]){
                    //Create nested array if undefined
                    if(typeof cat_array[result.moncat[month][monData]["category"]] == 'undefined'){cat_array[result.moncat[month][monData]["category"]] = {}};
                    //Push object of {month: value} to cat_array
                    console.log(result.moncat[month][monData]["SUM(pre_tax_amount)"]);
                    cat_array[result.moncat[month][monData]["category"]][month] = result.moncat[month][monData]["SUM(pre_tax_amount)"];
                }
            }

            //Create Table Header
            var header = "<thead><tr><th></th><th>" + Object.values(month_array).join("</th><th>") + "</th><th>Total</th></tr></thead>";
            var body_rows = "<tbody>";
            for (cat in cat_array){
                var row = "<tr class='table-data-row'><td class='table-cat'>" + cat + "</td>";

                //Populate table data replacing empty
                for(var d = 1; d < 13; d++){
                    if( cat_array[cat].hasOwnProperty(d)){
                        row += "<td class='table-data'>" + cat_array[cat][d] + "</td>";
                    }else{
                        row += "<td class='table-data'> 0 </td>";
                    }
                }
                //Add the last category total to the row
                row += "<td>" + result.cat[cat] +"</td></tr>";
                console.log(row);
                body_rows += row;
            }

            //Populate the month total row
            var tot_rows = "<tr><td>Total</td>";
            for(var i = 1; i < 13; i++){
                if(result.month.hasOwnProperty(i)){
                    tot_rows += "<td>" + result.month[i] + "</td>";
                }else{
                    tot_rows += "<td> 0 </td>";
                }
            }
            tot_rows += "<td></td></tr>";
            body_rows += tot_rows + "</tbody></table>";

            //Return jQuery object
            return $(table + header + body_rows );
        }

        var messageContainer = $('#upload-message');
        var uploadMessage = "";

        // Submit handler for uploading and processing csv
        $("#csvupload").submit(function(e){
            e.preventDefault();
            var loader = $("#loader-wrapper");

            /** Start loader */
            loader.fadeIn(100);
            
            /** Process form submission */
            var formData = new FormData(this);
            let files = $("#uploadfile").get(0).files;
            console.log(files);
            /** Check if files uploaded */
            if (files.length > 0 && (files[0].type.indexOf('csv') !== -1 || files[0].type.indexOf('excel') !== -1)) {
                formData.append("uploadfile", files[0]);
            }else{
                uploadMessage = "Please upload a valid CSV format file";
                messageContainer.html('<h3>' + uploadMessage + '</h3>');
                loader.fadeOut(100);
            }
            $.ajax({
                type: "POST",
                url: "/csv-upload",
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            }).done(function(response){
                console.log(response);
                if(response.success){
                    htmlTable = generateTable(response.result);
                    console.log(response.result);
                    console.log(htmlTable);
                    $('.frame').hide(200);
                    loader.fadeOut(100);
                    $('.table').append(htmlTable.css({left: "-3000px"}));
                    $('#return').show(300, function(){
                        $(this).fadeTo(300, 1);
                    });
                }
            })
        })
    })
})(jQuery);