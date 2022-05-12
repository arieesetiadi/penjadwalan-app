$(function () {
    // Toggle edit profile
    $("#show-profile-form-container").on("click", function () {
        $("#profile-form-container").toggleClass("d-none");
    });

    // Toggle tambah ruangan
    $("#btn-room-create").on("click", function () {
        $("#form-room-edit").addClass("d-none");
        $("#form-room-create").toggleClass("d-none");
    });

    // Toggle ubah ruangan
    $(".btn-room-edit").on("click", function () {
        $("#form-room-create").addClass("d-none");
        $("#form-room-edit").removeClass("d-none");

        // Asign nama ruangan ke form
        let roomName = $(this).data("name");
        let roomId = $(this).data("id");

        $("#input-room-id").val(roomId);
        $("#input-room-name").val(roomName);
    });
});
