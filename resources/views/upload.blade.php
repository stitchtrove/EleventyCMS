<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />


</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <form action="/file-upload" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
        @csrf;
        <!-- <div class="my-dropzone">
        Drag and drop zip files here, or click here to upload.
    </div> -->
    </form>


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
</body>

</html>