$(document).ready(function(){
    $('.tab-trigger').on('click', function(e){
        $('.tab-trigger').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').removeClass('db').addClass('dn');
        $('#'+$(this).attr('id')+'-content').toggleClass('dn db');
    });
});