/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    config.language = 'it';
    // config.uiColor = '#AADC6E';
    config.toolbar = 'Full';

    config.toolbar_Full =
        [
            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript' ] },
            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
            { name: 'insert', items : [ 'Table','HorizontalRule','Smiley','SpecialChar' ] },
            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote',
                '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
            { name: 'colors', items : [ 'TextColor','BGColor' ] },
            {name: 'insert', items: [ 'Image' ] },
            { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
            { name: 'links', items : [ 'Link','Unlink' ] },
            { name: 'document', items : [ 'Source']}
        ];
};
CKEDITOR.config.allowedContent = true;