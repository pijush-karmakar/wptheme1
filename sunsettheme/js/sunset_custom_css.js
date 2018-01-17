jQuery(document).ready(function($){

 var updateCSS = function(){ $('#sunset_custom_css').val(editor.getSession().getValue() ); }

 $('#sunset-custom-css-form').submit( updateCSS );

});



var editor = ace.edit("customCSS");
editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/css");