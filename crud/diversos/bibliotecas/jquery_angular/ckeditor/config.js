/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

    config.skin = 'moono';
    config.language= 'pt-br';
    config.enterMode = CKEDITOR.ENTER_DIV;
    config.shiftEnterMode= CKEDITOR.ENTER_P;

    config.fontSize_sizes = '8/8pt;9/9pt;10/10pt;11/11pt;12/12pt;14/14pt;16/16pt;18/18pt;20/20pt;22/22pt;24/24pt;26/26pt;28/28pt;36/36pt;48/48pt;72/72pt' ;

    config.tabSpaces = 4;
    config.disableNativeSpellChecker = false;
    config.removePlugins = 'elementspath';
    config.resize_enabled = true;
    config.toolbarCanCollapse = false;
    config.toolbar_mail =
        [
            ['Scayt','-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','Link','Unlink','Anchor','-','Find','Replace','-','Outdent','Indent','-','Table','HorizontalRule','SpecialChar','expAddImage', 'Image','-','Maximize'], '/',
            ['Font','FontSize','Bold','Italic','Underline','Strike','TextColor','BGColor','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList','-','expSignature']
        ];

    config.toolbar_signature =
        [
            ['Scayt','-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','Link','Unlink','Anchor','-','Outdent','Indent','-','Table','HorizontalRule','SpecialChar','-','Maximize'],'/',
            ['Font','FontSize','Bold','Italic','Underline','Strike','TextColor','BGColor','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList']
        ];
};
