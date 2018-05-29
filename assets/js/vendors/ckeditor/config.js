
CKEDITOR.editorConfig = function( config ) {
    config.toolbarGroups = [
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'forms', groups: [ 'forms' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'insert', groups: [ 'insert' ] },
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'about', groups: [ 'about' ] },
        { name: 'document', groups: [ 'mode', 'doctools', 'document' ] },
    ];
    config.extraPlugins = 'autolink';
    config.removePlugins = 'elementspath';
    config.resize_enabled = false;
    config.removeButtons = 'Save,NewPage,Preview,Print,Templates,PasteFromWord,PasteText,Redo,Undo,Cut,Copy,Paste,Form,Find,Scayt,SelectAll,Replace,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Subscript,Superscript,CopyFormatting,Outdent,Indent,Blockquote,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,BidiRtl,Language,BidiLtr,Anchor,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,FontSize,ShowBlocks,About,Maximize,BGColor,TextColor,Font,Styles';
};