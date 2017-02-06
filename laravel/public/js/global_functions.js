//General form validation for required items, only submits 
function validateForm(formId){
    var validForm =true;
    //var alertMsg = ""; //Not needed on nri csv task so comment out
    //Incase 2 forms on page
    var formIdSelector = "#"+formId;
    $(formIdSelector+" input.required").each( function() {
        var el = $(this);
        if(el.hasClass("input-invalid")){
            el.removeClass("input-invalid");
        }
        if($.trim(el.val())==""){
            el.addClass("input-invalid");
            validForm = false;
        }
    });
    if(!validForm){
        alert("Please fill out all highlighted fields.");//+alertMsg
        //Focuses on first invalid item incase of long form
        $(window).scrollTop($(".input-invalid").eq(0).offset().top-$(".input-invalid").parent().outerHeight()-10);
    }else{
        $(formIdSelector)[0].submit();
    }
}


