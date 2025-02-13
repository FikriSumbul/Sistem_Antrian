<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="booystrap-5.3.3-dist/css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <nav class="navbar bg-satu px-5 fixed-top" style="height: 80px">
            <div class="row ml-3 align-items-center rounded-4 bg-white">
                <div class="col-3 d-flex justify-content-center">
                    <a href="#" class="justify-content-center align-items-center w-100">
                        <img src="/gambar/.png.png" alt="Logo" width="50" height="50">
                    </a>
                </div>
                <div class="col-9">
                    <a href="#" style="text-decoration: none; font-family: Arial, Helvetica, sans-serif;">
                        <h3 class="text-info fw-bold m-0">Kemenkes</h3>
                        <h5 class="text-tiga fw-bold m-0">RS Mata Makassar</h5>
                    </a>
                </div>
            </div>
            <div class="col ml-auto text-end text-white">
                <div class="row">
                    <div class="col-10 pe-1 d-flex flex-column justify-content-center text-end">
                        <div id="hari" class="text-dua fw-bold fs-5"></div>
                        <div id="tanggal" class="text-white fs-6"></div>
                    </div>
                    <div class="col-2 pe-4 d-flex flex-column align-items-center justify-content-center">
                        <div id="waktu" class="fs-1 fw-semibold text-white"></div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="bg-light w-100" style="min-height: 595px;">
            @yield('halamanuser')
            @yield('halamanclient')
        </div>

        <script src="{{ asset('js/waktu.js') }}"></script>
    </body>
</html>
