$(function () {
    $("a#toggle-password").click(function () {
        // ganti icon setiap di klik
        $("i#eye-icon").toggleClass("bi-eye").toggleClass("bi-eye-slash");

        // ubah tipe input antara text - password
        let input = $("input#password");
        let type = input.prop("type");

        if (type == "password") {
            input.prop("type", "text");
        } else {
            input.prop("type", "password");
        }
    });
});
