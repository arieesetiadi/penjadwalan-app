$(function () {
    // Url user search API
    let url = $("#url-user-search").attr("content");
    let csrf = $("#csrf-token").attr("content");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": csrf,
        },
    });

    // Ketika user typing
    $("#input-user-search").on("input", function () {
        // Ambil user key
        let key = $(this).val();

        $.ajax({
            url: url,
            data: {
                key: key,
            },
            method: "POST",
            success: function (data) {
                console.log(data);
            },
        });
    });
});
