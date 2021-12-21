$(function () {
    const searchInstansiUrl = $("input#instansi").data("url");

    // $.ajaxSetup({
    //     headers: {
    //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //     },
    // });

    // $.ajax({
    //     url: searchInstansiUrl,
    //     data: {
    //         name: "dinas",
    //     },
    //     method: "POST",
    //     success: function (data) {
    //         console.log(data);
    //     },
    // });

    $("input#instansi").typeahead({
        source: function (query, process) {
            return $.get(searchInstansiUrl, { name: query }, function (data) {
                return process(data);
                // console.log(data);
            });
        },
    });
});
