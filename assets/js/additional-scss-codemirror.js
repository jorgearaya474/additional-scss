document.addEventListener('DOMContentLoaded', function() {
    const editorElement = document.getElementById('scss_additional_code');
    if (editorElement) {
        const editor = CodeMirror.fromTextArea(editorElement, {
            lineNumbers: true,
            mode: 'text/x-scss',
            theme: 'default',
        });
    }
});
