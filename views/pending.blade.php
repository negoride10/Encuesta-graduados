@component('templates.main')
    @slot('title')
        Encuestas pendientes de aprobación
    @endslot

    @slot('header')
        <script src="/tablefilter/tablefilter.js"></script>
        {{--DISABLING FILTER ON LAST COLUMN--}}
        <style>
            #flt10_table1 {
                display: none;
            }

            #flt10_table2 {
                display: none;
            }
        </style>
    @endslot

    @if(isset($message))
        <div class="toast align-items-center text-bg-danger border-0 position-fixed top-0 end-0 m-2" role="alert"
             aria-live="assertive" aria-atomic="true" id="messages">
            <div class="d-flex">
                <div class="toast-body">
                    {{$message}}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Cerrar"></button>
            </div>
        </div>
    @endif

    @if(isset($error))
        <div class="toast align-items-center text-bg-danger border-0 position-fixed top-0 end-0 m-2" role="alert"
             aria-live="assertive" aria-atomic="true" id="errors">
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
                <th scope="col">Nombre</th>
                <th scope="col">Correo electrónico</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Teléfono alterno</th>
                <th scope="col">País</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Dirección</th>
                <th scope="col">Fecha de recepción</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($graduatedAnswers as $key=>$answer)
                <tr>
                    <th scope="row">{{$answer['id']}}</th>
                    <td>{{$answer['identification_number']}}</td>
                    <td>{{$answer['name']}} {{$answer['last_name']}}</td>
                    <td>{{$answer['email']}}</td>
                    <td>{{$answer['mobile_phone']}}</td>
                    <td>{{$answer['alternative_mobile_phone']}}</td>
                    <td>{{$answer['country']}}</td>
                    <td>{{$answer['city']}}</td>
                    <td>{{$answer['address']}}</td>
                    <td>{{$answer['created_at']}}</td>
                    <td class="align-middle">
                        <div>
                            <button type="button" class="btn btn-success d-block mb-2">Aprobar</button>
                            <form action="/deny.php" method="POST"
                                  onsubmit="return confirm('¿Estás seguro que deseas rechazar este registro? Este será eliminado permanentemente de esta pantalla.')">
                                <input type="text" name="id" value="{{$answer['id']}}" hidden>
                                <button type="submit" class="btn btn-danger">Rechazar</button>
                            </form>
                        </div>

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
                <th scope="col">Nombre</th>
                <th scope="col">Correo electrónico</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Teléfono alterno</th>
                <th scope="col">País</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Dirección</th>
                <th scope="col">Fecha de recepción</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notGraduatedAnswers as $key=>$answer)
                <tr>
                    <th scope="row">{{$answer['id']}}</th>
                    <td>{{$answer['identification_number']}}</td>
                    <td>{{$answer['name']}} {{$answer['last_name']}}</td>
                    <td>{{$answer['email']}}</td>
                    <td>{{$answer['mobile_phone']}}</td>
                    <td>{{$answer['alternative_mobile_phone']}}</td>
                    <td>{{$answer['country']}}</td>
                    <td>{{$answer['city']}}</td>
                    <td>{{$answer['address']}}</td>
                    <td>{{$answer['created_at']}}</td>
                    <td>
                        <form action="/resynchronize.php" method="POST" class="d-inline">
                            <input type="text" name="id" value="{{$answer['id']}}" hidden>
                            <input type="text" name="identification_number" hidden
                                   value="{{$answer['identification_number']}}">
                            <button type="submit" class="btn btn-primary d-block mb-2">Sincronizar</button>
                        </form>

                        <form action="/deny.php" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Estás seguro que deseas rechazar este registro? Este será eliminado permanentemente de esta pantalla.')">
                            <input type="text" name="id" value="{{$answer['id']}}" hidden>
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
                //Toast
                @if(isset($error))

                const errorToast = document.getElementById('errors')

                const toast1 = new bootstrap.Toast(errorToast)
                toast1.show();
                @endif

                @if(isset($message))

                const messageToast = document.getElementById('messages')

                const toast2 = new bootstrap.Toast(messageToast)
                toast2.show();
                @endif

                //Tablefilter
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