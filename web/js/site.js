$('#sendLink').on('click', function() {
    $.ajax({
        type: "POST",
        url: "site/link",
        contentType: 'application/json; charset=utf-8',
        data: $("#link").val(),
        success: function (response) {
            console.log(response)
        },
        error: function (errorResponse) {
            console.log(errorResponse)
        }
    })
});