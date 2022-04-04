function loadImage(id) {
    console.log("#image-" + id);
    let fReader = null;
    let image = document.querySelector("#image-" + id);
    let imageName = image.files[0].name;
    let imagePreview = document.querySelector("#image-preview-" + id);

    fReader = new FileReader();
    fReader.readAsDataURL(image.files[0]);

    fReader.onload = function (e) {
        imagePreview.src = e.target.result;
    };
}
