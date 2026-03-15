


Dropzone.autoDiscover = false;
Dropzone.options.dpzSingleFile = true;
Dropzone.options.limitFiles = true;
$(function () {
  'use strict';
  var singleFile = $('#dpz-single-file');
  var multipleFiles = $('#dpz-multiple-files');
  var uploadfiles = $('#dpz-upload-file');
  var checkfile =$('#dpz-check-file');
  var buttonSelect = $('#dpz-btn-select-files');
  var limitFiles = $('#dpz-file-limits');
  var acceptFiles = $('#dpz-accept-files');
  var removeThumb = $('#dpz-remove-thumb');
  var removeAllThumbs = $('#dpz-remove-all-thumb');

  singleFile.dropzone({
    paramName: "file",
     maxFiles: 1,
     dictRemoveFile: ' Trash', 
     addRemoveLinks: true,
     maxThumbnailFilesize: 1,
     uploadMultiple: false,
    dictInvalidFileType:"You can't upload files of this type.",

    acceptedFiles:'image/jpg,image/jpeg,image/png ,application/pdf',
    init: function() {
    
        this.on("maxfilesexceeded", function(e) {
            this.removeAllFiles(), this.addFile(e)
            
        })
    },
      
   
  });
  checkfile.dropzone({
    paramName: "file",
     maxFiles: 1,
     dictRemoveFile: ' Trash', 
     addRemoveLinks: true,
     maxThumbnailFilesize: 1,
     uploadMultiple: false,
    dictInvalidFileType:"You can't upload files of this type.",

    acceptedFiles:'image/jpg,image/jpeg,image/png ,application/pdf',
    init: function() {
    
        this.on("maxfilesexceeded", function(e) {
            this.removeAllFiles(), this.addFile(e)
            
        })
    },
      
   
  });

  uploadfiles.dropzone({
    paramName: "file",
     maxFiles: 1,
    dictRemoveFile: ' Trash', 
     addRemoveLinks: true,
     maxThumbnailFilesize: 1,
     uploadMultiple: false,
     acceptedFiles: "image/*",
    init: function() {
        this.on("maxfilesexceeded", function(e) {
            this.removeAllFiles(), this.addFile(e)
            
        })
       
   
    }
  });
  // singleFile.dropzone({
  //   paramName: 'file', // The name that will be used to transfer the file
  //   maxFiles: 1,
  //   dictRemoveFile: ' Trash', 
  //    addRemoveLinks: true,
  //    maxThumbnailFilesize: 1,
  //    uploadMultiple: false,
  //   acceptedFiles:'image/* ,application/pdf',
    
  //   init: function() {
  //     this.on("maxfilesexceeded", function(e) {
  //         this.removeAllFiles(), this.addFile(e)
  //     })
  // }
  // });

  // Multiple Files
  multipleFiles.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 0.5, // MB
    clickable: true
  });

  // Use Button To Select Files
  buttonSelect.dropzone({
    clickable: '#select-files' // Define the element that should be used as click trigger to select files.
  });

  // Limit File Size and No. Of Files
  limitFiles.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFiles: 6,
    maxThumbnailFilesize: 1,// MB,
    dictRemoveFile: ' Trash', 
    addRemoveLinks: true,
    autoProcessQueue: false,
     dictInvalidFileType:"You can't upload files of this type.",
    acceptedFiles: 'image/*',
    
      init: function() {

        this.on("maxfilesexceeded", function(file) {
          alert("You are not allowed to upload more than 6 file!");
          this.removeFile(file);
   
        });
  
  }
  });

  // Accepted Only Files
  acceptFiles.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 1, // MB
    acceptedFiles: 'image/*'
  });

  //Remove Thumbnail
  removeThumb.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 1, // MB
    addRemoveLinks: true,
   
    
    accept: function(file, done) {
  
    
   
        //update progressbar, that works              
        //prints the correct filenames
        
        //does not work: only last file.name in queue is shown, 
        //even in a real server environment where i upload many files
        $('.name').html(file.name);         

    
 
    }
  });

  // Remove All Thumbnails
  removeAllThumbs.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 1, // MB
    init: function () {
      // Using a closure.
      var _this = this;

      // Setup the observer for the button.
      $('#clear-dropzone').on('click', function () {
        // Using "_this" here, because "this" doesn't point to the dropzone anymore
        _this.removeAllFiles();
        // If you want to cancel uploads as well, you
        // could also call _this.removeAllFiles(true);
      });
    }
  });
});
