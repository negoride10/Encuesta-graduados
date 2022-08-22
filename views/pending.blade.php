<!doctype html>
<html lang="es" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Encuestas pendientes de aprobación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="/tablefilter/tablefilter.js"></script>
    {{--DISABLING FILTER ON LAST COLUMN--}}
    <style>
        #flt4_table1 {
            display: none;
        }

        #flt4_table2 {
            display: none;
        }
    </style>
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
<main class="flex-shrink-0 py-3">
    <div class="container">
        <h1 class="text-center mb-4">
            Encuestas pendientes de aprobación
        </h1>

        <h2 class="mb-4">
            Se encontraron como egresados en SIGA.
        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="table1">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Cédula</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Fecha de recepción</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($graduatedAnswers as $key=>$answer)
                    <tr>
                        <th scope="row">{{$answer['ID']}}</th>
                        <td>{{$answer['identification_number']}}</td>
                        <td>{{$answer['email']}}</td>
                        <td>{{$answer['created_at']}}</td>
                        <td>
                            <button type="button" class="btn btn-success">Aprobar datos ingresados</button>
                            <button type="button" class="btn btn-danger">Rechazar</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <h2 class="mt-4">
            No se encontraron como egresados en SIGA.
        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="table2">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Cédula</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Fecha de recepción</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notGraduatedAnswers as $key=>$answer)
                    <tr>
                        <th scope="row">{{$answer['ID']}}</th>
                        <td>{{$answer['identification_number']}}</td>
                        <td>{{$answer['email']}}</td>
                        <td>{{$answer['created_at']}}</td>
                        <td>
                            <button type="button" class="btn btn-primary">Volver a sincronizar</button>
                            <button type="button" class="btn btn-danger">Rechazar</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<footer class="footer mt-auto py-3 bg-dark">
    <div class="container">
        <span class="h3 text-white">Universidad de Ibagué ©</span>
    </div>
</footer>

{{--TABLEFILTER--}}
<script>

    let tfConfig = {
        paging: {
            results_per_page: ['Resultados: ', [10, 25, 50, 100]]
        },
        base_path: 'tablefilter/',
        alternate_rows: true,
        btn_reset: true,
        rows_counter: true,
        loader: true,
        status_bar: true,
        mark_active_columns: {
            highlight_column: true
        },
        highlight_keywords: true,
        no_results_message: true,
        extensions: [{
            name: 'sort'
        }],

        /** Bootstrap integration */

        // allows Bootstrap table styling
        themes: [{
            name: 'transparent'
        }]
    };

    const tf = new TableFilter(document.querySelector('#table1'), tfConfig);
    tf.init();

    const tf2 = new TableFilter(document.querySelector('#table2'), tfConfig);
    tf2.init();
</script>

{{--BOOTSTRAP JS--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>
</html>
