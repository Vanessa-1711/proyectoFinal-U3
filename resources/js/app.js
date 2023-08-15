

//import './bootstrap';
import Dropzone from "dropzone"
Dropzone.autoDiscover = false;
const dropzone = new Dropzone ('#dropzone',{
    dictDefaultMessage:'Sube una imagen aquí',
    acceptedFiles:".png,.jpg,.jpeg",
    addRemoveLinks:true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,
    //trabajando con imagen en el contenedor de dropzone
    init: function () {
        // Verifica si hay una imagen ya almacenada en el input con name="imagen"
        const existingImage = document.querySelector('[name="imagen"]').value.trim();
        if (existingImage) {
            // Crea una miniatura para la imagen existente usando la URL correcta
            const mockFile = { name: existingImage, size: 1234 };
            this.options.addedfile.call(this, mockFile);
            this.options.thumbnail.call(
                this,
                mockFile,
                `/uploads/${existingImage}`
            );
            mockFile.previewElement.classList.add("dz-success", "dz-complete");
        }
    }
    
});
//eventos de dropzone
/*dropzone.on('sending', function(file,xhr,formdata){
    console.log(file);
});*/

//evento de envio de correo correcto
dropzone.on('success', function(file,response){
    document.querySelector('[name= "imagen"]').value = response.imagen;
});

//envio cuando hay error
dropzone.on('error', function(file,message){
    console.log(message);
});


//remover un archivo
dropzone.on('removedfile', function(){
    document.querySelector('[name= "imagen"]').value="";
});
