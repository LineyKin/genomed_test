$('#sendLink').on('click', function() {
    $.ajax({
        type: "POST",
        url: "site/link",
        data: {
            link: $("#link").val()
        },
        success: function (response) {
            let shortLink = $("#short_link");
            shortLink.attr("href", response.short_link)
            shortLink.html(response.short_link)
            $("#short_link_label").show()
        },
        error: function (errorResponse) {
            console.log("ERROR")
            console.log(errorResponse)
        }
    })
});