<html>
    <head>
        <title>Dropzone PDF Upload in Laravel</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
        rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    </head>
    
    <body>
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Dropzone PDF Upload in Laravel</h1><br>
                    <form action="{{ route('pdf.store') }}" method="post" class="dropzone" id="pdf-upload">
                    @csrf
                </form>
                <button type="button" id="button" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var MyDropzone = new Dropzone ('#pdf-upload', {
                maxFilesize: 1,
                acceptedFiles: ".pdf",
                addRemoveLinks: true,
                autoProcessQueue: false,
                init: function() {

                    //Aksi ketika button upload di klik
                    $("#button").click(function (e) {
                        e.preventDefault();
                        if (MyDropzone.files.length === 0) {
                            alert ("Pilih satu file untuk diunggah");
                            return;
                        }
                        MyDropzone.processQueue();
                    });

                    this.on('sending', function(file, xhr, formData) {
                        //tambahkan semua input form ke formdata dropzone yang akan post
                        var data = $('#pdf-upload').serializeArray();
                        $.each(data, function(key, el) {
                            formData.append(el.name, el.value);
                        });
                    });

                    this.on("queuecomplete", function () {
                        alert ("File berhasil diunggah!");
                    });
                }
            });
        </script>
    </body>
</html>