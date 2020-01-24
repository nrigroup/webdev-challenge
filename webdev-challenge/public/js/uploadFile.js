
// $(document).ready(function() {
//     $("#input-b2").fileinput({
//         uploadUrl: "?name=",
//         allowedFileExtensions: ['csv','pdf','jpg'],
//         uploadAsync: true
//
//     });
//
// });
$(document).ready(function() {
    $("#input-b2").fileinput({
        allowedFileExtensions: ['csv','pdf','jpg'],
        uploadUrl: 'http://127.0.0.1:8000/api/fileupload',
    });
});
