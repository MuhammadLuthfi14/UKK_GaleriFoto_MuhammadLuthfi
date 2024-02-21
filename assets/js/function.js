// Script - Script Function Website Galeri
function redirect(url) {
  window.location.href = url;
}

function previewImage() {
  const image = document.querySelector("#image");
  const imgPreview = document.querySelector(".img-preview");
  const uploadText = document.getElementById("uploadText");

  imgPreview.style.display = "block";
  uploadText.style.display = "none";

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };
}

function previewImageEdit() {
  const image = document.querySelector("#image-edit");
  const imgPreview = document.querySelector(".img-preview-edit");

  imgPreview.style.display = "block";

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };
}

function validateForm() {
  var namaAlbum = document.getElementById("namaalbum").value.trim();
  if (namaAlbum === "") {
    showAlert("Nama album tidak boleh kosong!");
    return false;
  }
  return true;
}
