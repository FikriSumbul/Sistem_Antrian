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
        <nav class="navbar bg-satu py-3 px-5 fixed-top">
            <div class="row ml-3 p-2 w-25 align-items-center rounded-4 bg-white">
                <div class="col-3 d-flex justify-content-center">
                    <a href="#" class="justify-content-center align-items-center w-100">
                        <img src="/gambar/.png.png" alt="Logo" width="70" height="70">
                    </a>
                </div>
                <div class="col-9">
                    <a href="#" style="text-decoration: none; font-family: Arial, Helvetica, sans-serif;">
                        <h3 class="text-info fw-bold m-0">Kemenkes</h3>
                        <h5 class="text-info m-0">RS Mata Makassar</h5>
                    </a>
                </div>
            </div>
            <div class="col ml-auto text-end text-white">
                <div class="row">
                    <div class="col-10 pe-1 d-flex flex-column justify-content-center text-end">
                        <div id="day-name" class="text-dua fw-bold fs-5"></div>
                        <div id="date-info" class="text-white fs-6"></div>
                    </div>
                    <div class="col-2 pe-4 d-flex flex-column align-items-center justify-content-center">
                        <div id="time-container" class="fs-1 fw-semibold text-white"></div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="bg-light w-100" style="min-height: 595px; height: auto; overflow: auto; margin-top: 100px">
            @yield('halamanuser')
        </div>

        <script>
            function updateTime() {
                const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                const now = new Date();
                const dayName = days[now.getDay()];
                const day = now.getDate();
                const monthName = months[now.getMonth()];
                const year = now.getFullYear();
                const hours = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');
                const seconds = now.getSeconds().toString().padStart(2, '0');

                document.getElementById("day-name").textContent = dayName;
                document.getElementById("date-info").textContent = `${day} ${monthName} ${year}`;
                document.getElementById("time-container").textContent = `${hours}:${minutes}:${seconds}`;
            }

            setInterval(updateTime, 1000);
            updateTime();
        </script>
    </body>
</html>
