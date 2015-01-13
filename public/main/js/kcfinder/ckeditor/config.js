/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
   config.filebrowserBrowseUrl = 'http://localhost/framework/js/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = 'http://localhost/framework/js/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = 'http://localhost/framework/js/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl = 'http://localhost/framework/js/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = 'http://localhost/framework/js/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = 'http://localhost/framework/js/kcfinder/upload.php?type=flash';
   
};
