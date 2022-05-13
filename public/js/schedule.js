$(function () {
    // Ubah warna tombol ketika diklik
    $(".date-button").on("click", function () {
        $(".date-button").removeClass("btn-secondary text-white");
        $(this).addClass("btn-secondary text-white");
        $(".date-button-active");
        validateDate();
    });
    validateHour();
    validateDate();
});

function setDateToForm(date) {
    // Set date to form
    $("input[name=date]").val(date);
}

function validateHour() {
    let start = $("input[name=start]").val();
    let end = $("input[name=end]").val();

    if (start != "" && end != "") {
        if (start >= end) {
            $("#btn-request-submit").addClass("disabled");
            $("#msg-time-invalid").removeClass("d-none");
        } else {
            $("#btn-request-submit").removeClass("disabled");
            $("#msg-time-invalid").addClass("d-none");
        }
    }
}

function validateDate() {
    let input = $("input[name=date]");

    let selected = new Date(input.val()).setHours(0, 0, 0, 0);
    let now = new Date().setHours(0, 0, 0, 0);

    if (selected < now) {
        $("#btn-request-submit").addClass("disabled");
        $("#msg-date-invalid").removeClass("d-none");
    } else {
        $("#btn-request-submit").removeClass("disabled");
        $("#msg-date-invalid").addClass("d-none");
    }
}
