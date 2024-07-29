document.addEventListener('DOMContentLoaded', function() {
    const editorElement = document.getElementById('scss_additional_code');
    if (editorElement) {
        const editor = CodeMirror.fromTextArea(editorElement, {
            lineNumbers: true,
            mode: 'text/x-scss',
            theme: 'default',
            tabSize: 2,
            lineWrapping: true,
            lint: true,
            gutters: ["CodeMirror-lint-markers"],
            extraKeys: {
                "Ctrl-Space": "autocomplete",
                "Enter": "newlineAndIndentContinueMarkdownList"
            },
            autoCloseBrackets: true,
            matchBrackets: true,
        });

        // Run auto completion
        editor.on("inputRead", function (cm, change) {
            CodeMirror.commands.autocomplete(cm);
        });
    }
});
