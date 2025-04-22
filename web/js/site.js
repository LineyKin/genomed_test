$('#sendLink').on('click', function() {
    let shortLinkError = $("#short_link_error");
    let shortLink = $("#short_link");
    let shortLinkLabel = $("#short_link_label")
    $.ajax({
        type: "POST",
        url: "site/link",
        data: {
            link: $("#link").val()
        },
        success: function (response) {
            shortLink.attr("href", response.short_link)
            shortLink.html(response.short_link)
            shortLinkLabel.show()
            shortLink.show()
            shortLinkError.hide()
        },
        error: function (errorResponse) {
            shortLinkError.html(errorResponse.responseJSON.message)
            shortLinkError.show()
            shortLinkLabel.hide()
            shortLink.hide()
        }
    })
});