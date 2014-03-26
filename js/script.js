tinymce.init({
  selector: "textarea.richtext-editor",
  menubar: false,
  statusbar: false,
  skin: "eve",
  language: "pt_BR",
  filemanager_title:"Gerenciador de arquivos",
  relative_urls: true,
  external_filemanager_path:"/tinymce/js/tinymce/plugins/filemanager/",
  external_plugins: { "filemanager" : "plugins/responsivefilemanager/plugin.js"},
  plugins: [
            "charmap link lists autolink anchor responsivefilemanager",
            "searchreplace code fullscreen",
            "table contextmenu paste"
  ],
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link responsivefilemanager"
});

$(document).ready(function(){
  $('input.datetime').each(function(){
    
    switch($(this).attr('data-type')){
      case"date":
        var date = true;
        var time = false;
        break;
      case"time":
        var date = false;
        var time = true;
        break;
      case"datetime":
      default:
        var date = true,
            time = true;
        break;
    }
    
    var input = $(this),
        format = input.attr('data-format'),
        container = '<div class="input-append input-group date">';
        container += '<span class="input-group-addon add-on">';
        container += '<i data-time-icon="glyphicon glyphicon-time" data-date-icon="glyphicon glyphicon-calendar" class="glyphicon glyphicon-calendar"></i>';
        container += '</span>';
        container += '</div>';
    container = $(container);
    container.insertBefore(input);
    input.prependTo(container);
    
    container.datetimepicker({
      collapse: true,
      language: "pt_BR",
      pickDate: date,
      pickTime: time
    });
  });
});