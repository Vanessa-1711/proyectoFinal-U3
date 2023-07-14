import Dropzone from 'dropzone';
Dropzone.autoDiscover = false;
const dropzoneProductos = new Dropzone('#dropzoneProductos', {
    dictDefaultMessage: "Sube tu imagen aquí",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, '/uploads/' + imagenPublicada.name);
            imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
        }
    },
});

dropzoneProductos.on('success', function(file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzoneProductos.on('error', function(file, message) {
    console.log(message);
});

dropzoneProductos.on('removedfile', function() {
    document.querySelector('[name="imagen"]').value = '';
});
