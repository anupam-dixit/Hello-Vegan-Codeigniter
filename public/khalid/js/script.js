function pitFetch(method="GET",url,formData) {
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
    return $.ajax({type: method, url: url, data: formData,
        beforeSend: function () {;},
        success: function (data) {;},
        complete: function (data) {;}
    });
}

$(document).ready(function () {
    $("#preloader").slideUp(500,function () {
        $("main").removeClass('d-none')
    })
})