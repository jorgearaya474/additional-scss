document.addEventListener('DOMContentLoaded', function() {
    var editorElement = document.getElementById('scss_additional_code');
    if (editorElement) {
        var editor = CodeMirror.fromTextArea(editorElement, {
            lineNumbers: true,
            mode: 'text/x-scss',
            theme: 'default',
        });
    }
});
