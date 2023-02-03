/**
 * Ckeditor 4.4.7
 * http://ckeditor.com/addons/plugins/all
 */

CKEDITOR.editorConfig = function( config ) {
	
	config.filebrowserUploadUrl='/js/ckeditor/upload.php?file_type=attach';
	config.filebrowserImageUploadUrl='/js/ckeditor/upload.php?file_type=img';
	config.filebrowserFlashUploadUrl='/js/ckeditor/upload.php?file_type=flash';
	config.allowedContent=false;
	config.resize_enabled=false;
	config.toolbarCanCollapse=false;
	config.language='zh-cn';
	config.colorButton_enableMore=false;
	config.enterMode=CKEDITOR.ENTER_BR;
	config.font_names='黑体;宋体;新宋体;Arial;Times New Roman;Times;serif';
	config.fontSize_sizes='10px;12px;14px;16px;18px;20px;22px;24px;28px';
	config.undoStackSize=200;
	config.height=400;
	config.width=screen.width>1024?'80%':'90%';
	if(document.documentElement.scrollWidth*parseInt(config.width, 10)/100<650){
		config.width=600;
	}
	
	config.toolbar_Full = [
	['Source','-','Save','NewPage','Preview','-','Templates'],
	['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
	'/',
	['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	['Link','Unlink','Anchor'],
	['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
	'/',
	['Styles','Format','Font','FontSize'],
	['TextColor','BGColor']
	];
	
	config.extraPlugins = 'dialog,dialogui,colordialog,colorbutton,button,panel,floatpanel,panelbutton,flash,font,find,selectall,indent,indentlist,indentblock,justify,iframedialog,iframe';

};

