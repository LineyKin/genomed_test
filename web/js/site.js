$('#sendLink').on('click', function() {
    let shortLinkError = $("#short_link_error");
    let shortLink = $("#short_link");
    let shortLinkWrap = $("#short_link_wrap");
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
            shortLinkWrap.show()
            shortLinkError.hide()
            qr.qrcode(originalUrl);
        },
        error: function (errorResponse) {
            shortLinkError.html(errorResponse.responseJSON.message)
            shortLinkError.show()
            shortLinkWrap.hide()
            qr.empty()
        }
    })
});