@component('templates.main')
    @slot('title')
        Encuestas pendientes de aprobación
    @endslot

    @slot('header')
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
    @endslot

    @if(isset($error))
        <div class="toast align-items-center text-bg-danger border-0 position-fixed top-0 end-0 m-2" role="alert"
             aria-live="assertive" aria-atomic="true" id="liveToast">
            <div class="d-flex">
                <div class="toast-body">
                    {{$error}}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Cerrar"></button>
            </div>
        </div>
    @endif
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
                        <form action="/resynchronize.php" method="POST">
                            <input type="text" name="id" value="{{$answer['ID']}}" hidden>
                            <input type="text" name="identification_number" hidden
                                   value="{{$answer['identification_number']}}">
                            <button type="submit" class="btn btn-primary">Volver a sincronizar</button>
                        </form>

                        <form action="/deny.php" method="POST"
                              onsubmit="return confirm('¿Estás seguro que deseas rechazar este registro? Este será eliminado permanentemente de esta pantalla.')">
                            <input type="text" name="id" value="{{$answer['ID']}}" hidden>
                            <button type="submit" class="btn btn-danger">Rechazar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @slot('scripts')
        <script>
            window.addEventListener('load', function () {


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


            })
        </script>
    @endslot

@endcomponent