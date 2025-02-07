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
        <nav class="navbar bg-navbar py-3 px-5">
            <div class="row ml-3 align-items-center w-25">
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
                <span id="current-time" style="font-family: Arial, Helvetica, sans-serif;"></span>
            </div>
        </nav>
        <div class="bg-admin w-100" style="height: 593px">
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

                const currentTimeString = `${dayName}, ${day} ${monthName} ${year} | ${hours}:${minutes}:${seconds}`;

                document.getElementById("current-time").textContent = currentTimeString;
            }

            setInterval(updateTime, 1000);
            updateTime();
        </script>
    </body>
</html>
