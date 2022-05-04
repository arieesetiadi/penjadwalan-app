$(function () {
    // Ubah warna tombol ketika diklik
    $(".date-button").on("click", function () {
        $(".date-button").removeClass("btn-secondary");
        $(this).addClass("btn-secondary");
        $(".date-button-active");
    });
});

function setDateToForm(date) {
    // Set date to form
    $("input[name=date]").val(date);
}
