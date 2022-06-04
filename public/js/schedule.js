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
    validateHour();
}

function validateHour() {
    const format = "Y-MM-D HH:mm:ss";

    const date = $("input[name=date]").val();
    const start = $("input[name=start]").val();
    const end = $("input[name=end]").val();

    // Validasi datetime jika jam sudah terisi
    if (start != "" && end != "") {
        const now = moment();
        const momentStart = moment(date + " " + start);
        const momentEnd = moment(date + " " + end);

        // Disable tombol jika jam sudah lewat
        if (momentStart.isBefore(now) || momentEnd.isBefore(now)) {
            $("#btn-request-submit").addClass("disabled");
            $("#msg-time-invalid").removeClass("d-none");
            return;
        }
        // Disable jika jam mulai lebih besar dari jam selesai
        else if (momentStart.isAfter(momentEnd) || momentStart.isSame(momentEnd)) {
            $("#btn-request-submit").addClass("disabled");
            $("#msg-time-invalid").removeClass("d-none");
            return;
        }
        // Normal, hidupkan tombol
        else {
            $("#btn-request-submit").removeClass("disabled");
            $("#msg-time-invalid").addClass("d-none");
            return;
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
