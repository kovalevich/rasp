$(document).ready(function() {

    $('#editor').redactor({
        buttonSource: true,
        lang: 'ru',
        imageUpload: upload_image,
        convertVideoLinks: true,
        minHeight: 600,
        maxHeight: 800,
        autosave: admin_edit_company_auto_save_url,
        autosaveInterval: 3,
        autosaveName: 'value',
        buttons: ['html', 'formatting', 'bold', 'italic', 'deleted',
            'unorderedlist', 'orderedlist', 'outdent', 'indent',
            'image', 'video', 'link', 'alignment', 'horizontalrule'],
        plugins: ['fullscreen', 'table', 'video'],
        changeCallback: function()
        {
            $('.save-indicator').removeClass("fa-save").addClass("fa-circle-o-notch").addClass("fa-spin");
        },
        autosaveCallback: function(name, json)
        {
            $('.save-indicator').removeClass("fa-circle-o-notch").removeClass("fa-spin").addClass("fa-save");
        }
    });

    $('.editable').editable({
        url: admin_edit_company_url,
        ajaxOptions: {
            type: 'post',
            dataType: 'json'
        }
    });

    $('.editable-type').editable({
        url: admin_edit_company_url,
        source: ajax_types
    });

    $('.editable-title').editable('option', 'validate', function(v) {
        if(!v) return 'Заголовок не может быть пустым';
    });

});