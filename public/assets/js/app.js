document.addEventListener("DOMContentLoaded", function () {
    const photoInput = document.querySelector("input[name='photo']");
    const previewBox = document.querySelector(".rounded-circle");

    if (photoInput && previewBox) {
        photoInput.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    ppreviewBox.style.backgroundImage = `url(${e.target.result})`;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
