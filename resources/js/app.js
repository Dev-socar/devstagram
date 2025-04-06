import Dropzone from "dropzone";

if (document.querySelector("#dropzone")) {
    Dropzone.autoDiscover = false;

    const dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Sube aqui tu imagen",
        acceptedFiles: ".jpg, .jpeg, .png, .gif",
        addRemoveLinks: true,
        dictRemoveFile: "Eliminar imagen",
        maxFiles: 1,
        uploadMultiple: false,

        init: function () {
            if (document.querySelector("[name='imagen']").value.trim()) {
                const imagenPublicada = {};
                imagenPublicada.size = 1234;
                imagenPublicada.name =
                    document.querySelector("[name='imagen']").value;

                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(
                    this,
                    imagenPublicada,
                    `/uploads/${imagenPublicada.name}`
                );
                imagenPublicada.previewElement.classList.add(
                    "dz-success",
                    "dz-complete"
                );
            }
        },
    });

    dropzone.on("success", function (file, { imagen }) {
        document.querySelector("[name='imagen']").value = imagen;
    });

    dropzone.on("removedfile", function () {
        document.querySelector("[name='imagen']").value = "";
    });
}
