$('#sendLink').on('click', function() {
    let shortLinkError = $("#short_link_error");
    let shortLink = $("#short_link");
    let shortLinkLabel = $("#short_link_label")
    let originalUrl = $("#link").val()
    let qr = $('#qrcode')

    $.ajax({
        type: "POST",
        url: "site/link",
        data: {
            link: originalUrl
        },
        success: function (response) {
            shortLink.attr("href", response.short_link)
            shortLink.html(response.short_link)
            shortLinkLabel.show()
            shortLink.show()
            shortLinkError.hide()
            qr.qrcode(originalUrl);
        },
        error: function (errorResponse) {
            shortLinkError.html(errorResponse.responseJSON.message)
            shortLinkError.show()
            shortLinkLabel.hide()
            shortLink.hide()
            qr.empty()
        }
    })
});