<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title }}</title>

    <!-- css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

    <!-- FONT -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600&display=swap"
        rel="stylesheet">


    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">











</head>

<body>



    @include('sweetalert::alert')
    @yield('container')

    {{-- bagian url untuk los --}}
    <script>
        var apiurl = "{{ config('api.url') }}";
        var url = '{{ route('home') }}';
    </script>
    <script src=" {{ asset('js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap JS (bundle version) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script src=" {{ asset('js/script.js') }}"></script>

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- <script>
        $('form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($('.form')[0]);
            $.ajax({
                method: 'POST',
                url: url,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Handle ketika sukses
                        alert(response.message);
                    } else {
                        // Handle ketika terjadi kesalahan
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat mengirim permintaan Ajax.');
                }
            });
        })
    </script> --}}


    <script>
        $('form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($('.form')[0]);
            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    // Lakukan sesuatu dengan respons, misalnya menampilkan pesan ke pengguna
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat mengirim permintaan Ajax.');
                },
            });
        })
    </script>




</body>

</html>
