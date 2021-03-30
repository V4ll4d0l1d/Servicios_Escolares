// disable autodiscover

Dropzone.autoDiscover = false;
if ($('#dropzone').length) {
var myDropzone = new Dropzone("#dropzone", {
    url: "uploadConcentrados.php",
    method: "POST",
    paramName: "file",
    autoProcessQueue : false,
    acceptedFiles: "application/pdf",
    maxFiles: 5,
    maxFilesize: 1.5, // MB
    uploadMultiple: true,
    parallelUploads: 100, // use it with uploadMultiple
    createImageThumbnails: true,
    thumbnailWidth: 120,
    thumbnailHeight: 120,
	renameFile:true,
    addRemoveLinks: true,
    timeout: 180000,
    dictRemoveFileConfirmation: "Are you Sure?", // ask before removing file
    // Language Strings
    dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
    dictInvalidFileType: "Invalid File Type",
    dictCancelUpload: "Cancel",
    dictRemoveFile: "Remove",
    dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
    dictDefaultMessage: "Drop files here to upload",
	
});
	
list_image();
myDropzone.on("addedfile", function(file) {
    //console.log(file);
	var ext = file.name.split('.').pop();
    if (ext == "pdf") {
        $(file.previewElement).find(".dz-image img").attr("src", "images/pdf.png");
    }
});

myDropzone.on("removedfile", function(file) {
    // console.log(file);
});

// Add mmore data to send along with the file as POST data. (optional)
myDropzone.on("sending", function(file, xhr, formData) {
    formData.append("dropzone", "1"); // $_POST["dropzone"]
});

myDropzone.on("error", function(file, response) {
    console.log(response);
});

// on success
myDropzone.on("successmultiple", function(file, response) {
    // get response from successful ajax request
    console.log(response);
    // submit the form after images upload
    // (if u want yo submit rest of the inputs in the form)
    document.getElementById("dropzone-form").submit();
});

myDropzone.on("complete", function(){
    if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
    {
     var _this = this;
     _this.removeAllFiles();
    }
    list_image();
   });  

// button trigger for processingQueue
var submitDropzone = document.getElementById("submit-dropzone");
submitDropzone.addEventListener("click", function(e) {
    // Make sure that the form isn't actually being sent.
    e.preventDefault();
    e.stopPropagation();

    if (myDropzone.files != "") {
        // console.log(myDropzone.files);
        myDropzone.processQueue();
    } else {
	// if no file submit the form    
        document.getElementById("dropzone-form").submit();
}});


 function list_image()
 {
  $.ajax({
   url:"uploadConcentrados.php",
   success:function(data){
    $('#preview').html(data);
   }
  });
 }
  $(document).on('click', '.remove_image', function(){
  var name = $(this).attr('id');
  var eliminar=1;
  $.ajax({
   url:"uploadConcentrados.php",
   method:"POST",
   data:{name:name,eliminar:eliminar},
   success:function(data)
   {
	   alert(data);
    list_image();
   }
  })
 });
}
$(document).on('blur', 'input', function(){
        var field = $(this);
        var validationField = field.parent().find('.validation');
        //var dataString ='new='++'&old='+field.attr('name');
		var modificar=1;
	$.ajax({
            type: "POST",
            url: "uploadConcentrados.php",
            data: {nuevo:field.val(),old:field.attr('name'),modificar:modificar},
            success: function(data) {
				alert('Se modifico el nombre del archivo');
				 list_image();
            }
        });
    });

