<x-layouts.app>
    <x-includes.page_header>Edit Content</x-includes.page_header>
    <!-- include libraries(jQuery, bootstrap) -->


    <!-- include summernote css/js -->
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />

    <form method="POST" action="/save" id="editPostForm" class="flex flex-col space-y-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <input type="hidden" name="newContent" id="newContent">
        <input type="hidden" id="oldContent" name="oldContent" value="{{ $safecontent }}">
        <div id="editor"></div>
        <div class="text-end">
            <button class="btn btn-success" style="margin-top: 20px;">
                Update post
            </button>
        </div>
    </form>
    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
    <script>
        const Editor = toastui.Editor;
        const editor = new Editor({
            el: document.querySelector('#editor'),
            height: 'calc(100vh - 200px)',
            initialEditType: 'markdown'
        });
        // set the old content
        editor.setMarkdown(document.querySelector('#oldContent').value);
        // on submit save the markdown to new content 
        document.querySelector('#editPostForm').addEventListener('submit', e => {
            e.preventDefault();
            document.querySelector('#newContent').value = editor.getMarkdown();
            e.target.submit();
        });
    </script>
</x-layouts.app>