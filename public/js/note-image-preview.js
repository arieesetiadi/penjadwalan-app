function loadImage() {
    removeNoteEmpty();

    // Show preview container
    $("#image-preview-container").removeClass("d-none");

    let fReader = null;
    let image = document.querySelector("#image");
    let imageName = image.files[0].name;
    let imagePreview = document.querySelector("#image-preview");

    fReader = new FileReader();
    fReader.readAsDataURL(image.files[0]);

    fReader.onload = function (e) {
        imagePreview.src = e.target.result;
    };
}
