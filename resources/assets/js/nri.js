$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            getLots(page);
        }
    }
});

$(document).ready(function() {
    $(document).on('click', '.pagination a', function (e) {
        getLots($(this).attr('href').split('page=')[1]);
        e.preventDefault();
        e.stopPropagation();
    });
});

function getLots(page) {
    $.ajax({
        url : '/lot/index?page=' + page,
        dataType: 'json',
    }).done(function (data) {
        $('#lots').html(data);
        location.hash = page;
    }).fail(function(xhr, status, error) {
        console.log(error);
    });
}