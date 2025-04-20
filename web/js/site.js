$('#sendLink').on('click', function() {
    $.ajax({
        type: "POST",
        url: "site/link",
        data: {
            link: $("#link").val()
        },
        success: function (response) {
            console.log("OK")
            console.log(response)
        },
        error: function (errorResponse) {
            console.log("ERROR")
            console.log(errorResponse)
        }
    })
});