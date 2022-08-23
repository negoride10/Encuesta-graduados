<!doctype html>

<html lang="es" class="h-100">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado individual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body class="d-flex flex-column justify-content-between h-100">
<header>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://www.unibague.edu.co/images/2022/Unibague-4.0.png"
                     alt="">
                <span class="h3 ms-2">
            Encuesta de egresados
        </span>
            </a>
        </div>
    </nav>
</header>

<form class="d-flex justify-content-center" method="post" action="/login.php">



    <div class="d-flex justify-content-center d-flex flex-column">
        <div>
            <label for="exampleInputEmail1">Correo Unibagué</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="Correo"
                   placeholder="Ingrese correo electrónico">


        </div>
        <label for="exampleInputPassword1">Contraseña</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
        <button style="background: #0f1f39; color: white  " type="submit" class="mt-2 btn btn-lg btn-block">Iniciar
            Sesión
        </button>


    </div>

</form>


<div>


    <footer class="footer mt-auto py-3 bg-dark">
        <div class="container">
            <span class="h3 text-white">Universidad de Ibagué ©</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
            crossorigin="anonymous"></script>


</div>
</body>
</html>
