$(function () {
    // Ubah warna tombol ketika diklik
    $(".date-button").on("click", function () {
        $(".date-button").removeClass("btn-secondary text-white");
        $(this).addClass("btn-secondary text-white");
        $(".date-button-active");
    });

    validateDate();
    validateHour();
});

function setDateToForm(date) {
    // Set date to form
    $("input[name=date]").val(date);
    validateDate();
    validateHour();
}

function validateHour() {
    const format = "Y-MM-D HH:mm:ss";

    const date = $("input[name=date]").val();
    const start = $("input[name=start]").val();
    const end = $("input[name=end]").val();

    const now = moment();
    const momentStart = moment(date + " " + start);
    const momentEnd = moment(date + " " + end);

    // Validasi datetime jika jam sudah terisi
    if (start != "" && end == "") {
        // Disable tombol jika jam sudah lewat
        if (momentStart.isBefore(now)) {
            $("button#btn-request-submit").prop('disabled', true);
            $("#msg-time-invalid").removeClass("d-none");
            return;
        } else {
            $("button#btn-request-submit").prop('disabled', false);
            $("#msg-time-invalid").addClass("d-none");
            return;
        }
    } else if (start == "" && end != "") {
        // Disable tombol jika jam sudah lewat
        if (momentEnd.isBefore(now)) {
            $("button#btn-request-submit").prop('disabled', true);
            $("#msg-time-invalid").removeClass("d-none");
            return;
        } else {
            $("button#btn-request-submit").prop('disabled', false);
            $("#msg-time-invalid").addClass("d-none");
            return;
        }
    } else if (start != "" && end != "") {
        if (momentStart.isBefore(now) || momentEnd.isBefore(now)) {
            $("button#btn-request-submit").prop('disabled', true);
            $("#msg-time-invalid").removeClass("d-none");
            return;
        }
        // Disable jika jam mulai lebih besar dari jam selesai
        else if (momentStart.isAfter(momentEnd) || momentStart.isSame(momentEnd)) {
            $("button#btn-request-submit").prop('disabled', true);
            $("#msg-time-invalid").removeClass("d-none");
            return;
        }
        // Normal, hidupkan tombol
        else {
            $("button#btn-request-submit").prop('disabled', false);
            $("#msg-time-invalid").addClass("d-none");
            return;
        }
    } else {
        $("button#btn-request-submit").prop('disabled', false);
        $("#msg-time-invalid").addClass("d-none");
        return;
    }
}

function validateDate() {
    let input = $("input[name=date]");

    let selected = new Date(input.val()).setHours(0, 0, 0, 0);
    let now = new Date().setHours(0, 0, 0, 0);

    if (selected < now) {
        $("button#btn-request-submit").prop('disabled', true);
        $("#msg-date-invalid").removeClass("d-none");
    } else {
        $("button#btn-request-submit").prop('disabled', false);
        $("#msg-date-invalid").addClass("d-none");
    }
}
