<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

	<style type="text/css">
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
	</style>
</head>

<body>

	<div id="container">
	<input type="file" 
    class="filepond"
    name="filepond" 
    multiple 
    data-allow-reorder="true"
    data-max-file-size="3MB"
    data-max-files="3">
	</div>
	<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>


	<script>
		FilePond.registerPlugin(
	// encodes the file as base64 data
	
	// encodes the file as base64 data
	FilePondPluginFileEncode,
	
	// validates the size of the file
	FilePondPluginFileValidateSize,
	
	// corrects mobile image orientation
	FilePondPluginImageExifOrientation,
	
	// previews dropped images
  FilePondPluginImagePreview
);

FilePond.setOptions({
    server: {
       //url:'upload',
	   process: {
		   url:'upload',
		  
	   },
	   ondata: (formData) => {
                formData.append('Hello', 'World');
                return formData;
            },
	 
    },
	
	labelFileProcessingComplete:'Agregado',
	credits:false,
	labelIdle:'Agrega tus archivitos',
	labelTapToUndo:'Eliminar',
	instantUpload:false

});

// Select the file input and use create() to turn it into a pond
// in this example we pass properties along with the create method
// we could have also put these on the file input element itself
var kkk=FilePond.create(
	document.querySelector('input')
);

document.addEventListener('FilePond:removefile', (e) => {
    console.log('FilePond ready for use', e.detail.file.file.name);
	console.log('FilePond ready for use', e.detail);

    // get create method reference
    const { create } = e.detail;
});
document.addEventListener('FilePond:addfilestart', (e) => {
	e.detail.file.file.name='jotillo';
    console.log('FilePond ready for use', e.detail.file.file.name);
	console.log('FilePond ready for use', e.detail);

    // get create method reference
    const { create } = e.detail;
});
	</script>
</body>

</html>