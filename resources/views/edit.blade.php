<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">


    <!-- include summernote css/js -->
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <form method="POST" action="/save" id="editPostForm" class="flex flex-col space-y-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <input type="hidden" name="newContent" id="newContent">
        <input type="hidden" id="oldContent" name="oldContent" value="{{ $safecontent }}">
        <div id="editor"></div>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-40">
            Update post
        </button>
    </form>
    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
    <script>
        const Editor = toastui.Editor;
        const editor = new Editor({
            el: document.querySelector('#editor'),
            height: '100vh',
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
</body>

</html>