//  todo charge image
const zonaCarga = document.getElementById("zona-carga");
const inputImagen = document.getElementById("recipient-profile_photo");
inputImagen.addEventListener("change", (e) => {
    zonaCarga.classList.toggle("zona-carga-active");
    const archivo = e.target.files[0];
    const reader = new FileReader();
    reader.onload = (e) => {
        const img = document.createElement("img");
        img.src = e.target.result;
        zonaCarga.innerHTML = "";
        zonaCarga.appendChild(img);
    };
    reader.readAsDataURL(archivo);
});
