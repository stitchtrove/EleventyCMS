<x-layouts.app>
    <x-includes.page_header>Upload existing content</x-includes.page_header>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .dropzone {
            text-align: center;
            padding: 20px;
            border: 3px dashed #eeeeee;
            background-color: #fafafa;
            color: #bdbdbd;

            margin-bottom: 20px;
        }

        .accept {
            border-color: #107c10 !important;
        }

        .reject {
            border-color: #d83b01 !important;
        }
    </style>
    <form action="/file-upload" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
        @csrf
    </form>


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        new Dropzone("#my-awesome-dropzone", {
            maxFilesize: 2, // MB
            init: function() {
                this.on("success", function(file, response) {
                    // Handle successful upload
                    window.location.href = '/content'; // Redirect to content page
                });
                this.on("error", function(file, errorMessage) {
                    // Handle upload error
                    console.log(errorMessage);
                });
            }
        });
    </script>
</x-layouts.app>