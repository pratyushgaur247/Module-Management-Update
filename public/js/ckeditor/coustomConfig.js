/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

 // CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// config.toolbarGroups = [
	// 	// { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	// 	// { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	// 	// { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	// 	// { name: 'forms', groups: [ 'forms' ] },
	// 	// { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// 	// { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
	// 	// { name: 'styles', groups: [ 'styles' ] },
	// 	// { name: 'colors', groups: [ 'colors' ] },
	// 	// { name: 'tools', groups: [ 'tools' ] },
	// 	// { name: 'links', groups: [ 'links'] },
	// 	{ name: 'insert', groups: [ 'insert', 'eqneditor' ] },
	// 	// { name: 'others', groups: [ 'others' ] },
	// 	// { name: 'about', groups: [ 'about' ] }
	// ];
	// config.mathJaxClass = 'math-tex';
	// config.extraPlugins = 'Mathjax';

	// config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.2-latest/MathJax.js?config=TeX-AMS_HTML';
	// config.removeButtons = 'Save,NewPage,mathjax,ExportPdf,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Form,Radio,Checkbox,TextField,Textarea,Select,Button,ImageButton,HiddenField,Language,Flash,Smiley,Iframe,TextColor,BGColor';
// 	config.toolbarGroups = [
// 		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
// 		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
// 		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
// 		{ name: 'forms', groups: [ 'forms' ] },
// 		'/',
// 		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
// 		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
// 		{ name: 'links', groups: [ 'links' ] },
// 		{ name: 'insert', groups: [ 'insert' ] },
// 		'/',
// 		{ name: 'styles', groups: [ 'styles' ] },
// 		{ name: 'colors', groups: [ 'colors' ] },
// 		{ name: 'tools', groups: [ 'tools' ] },
// 		{ name: 'others', groups: [ 'others' ] },
// 		{ name: 'about', groups: [ 'about' ] }
// 	];
// 	config.removeButtons = 'Source,Save,NewPage,ExportPdf,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Replace,Mathjax,Find,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Bold,CopyFormatting,RemoveFormat,Italic,Underline,Strike,Subscript,Superscript,NumberedList,BulletedList,Indent,Outdent,Blockquote,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Link,Unlink,Anchor,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,Font,FontSize,TextColor,Maximize,About,ShowBlocks,BGColor';
// };

// Message center ck editor
CKEDITOR.editorConfig = function( config ) {
config.toolbarGroups = [
{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
{ name: 'forms', groups: [ 'forms' ] },
'/',
{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
{ name: 'links', groups: [ 'links' ] },
{ name: 'insert', groups: [ 'insert' ] },
'/',
{ name: 'styles', groups: [ 'styles' ] },
{ name: 'colors', groups: [ 'colors' ] },
{ name: 'tools', groups: [ 'tools' ] },
{ name: 'others', groups: [ 'others' ] },
{ name: 'about', groups: [ 'about' ] }
];
config.removePlugins = 'eqneditor,Link,Unlink,Anchor';
config.removeButtons = 'Source,Save,Mathjax,Templates,Cut,Undo,Find,SelectAll,Scayt,Form,Bold,CopyFormatting,NumberedList,Outdent,Blockquote,JustifyLeft,BidiLtr,Link,Image,Styles,TextColor,Maximize,About,ShowBlocks,BGColor,Format,Font,FontSize,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Anchor,BidiRtl,Unlink,Language,JustifyRight,JustifyBlock,JustifyCenter,CreateDiv,Indent,BulletedList,RemoveFormat,Italic,Underline,Strike,Subscript,Superscript,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Replace,Redo,Copy,Paste,PasteText,PasteFromWord,Print,Preview,ExportPdf,NewPage';
};