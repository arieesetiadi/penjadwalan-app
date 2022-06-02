function createStrImage(image, i) {
    let fReader = new FileReader();
    let strImage = "";

    fReader.readAsDataURL(image);
    fReader.onload = function (e) {
        $("#carouselContainer").append(`
            <div class="carousel-item ${i == 0 ? "active" : ""}">
                <img style="max-height: 476px; max-width: 100%"
                    src="${e.target.result}"
                    class="d-block" alt="Image">
            </div>
        `);
    };
}

function clearCarousel() {
    const carouselItem = Array.from(
        document.getElementsByClassName("carousel-item")
    );

    for (let i =0; i < carouselItem.length; i++){
        carouselItem[i].remove();
    }
}

function loadImage() {
    clearCarousel();
    const images = document.querySelector("#image").files;

    // Show preview container
    $("#image-preview-container").removeClass("d-none");

    for (let i = 0; i < images.length; i++) {
        // Append all images
        createStrImage(images[i], i);
    }

    // =============================================
    // =============================================

    // Show preview container | Backup
    // $("#image-preview-container").removeClass("d-none");

    // let fReader = null;
    // let image = document.querySelector("#image");
    // let imageName = image.files[0].name;
    // let imagePreview = document.querySelector("#image-preview");

    // fReader = new FileReader();
    // fReader.readAsDataURL(image.files[0]);

    // fReader.onload = function (e) {
    //     imagePreview.src = e.target.result;
    // };
}
