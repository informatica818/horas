@extends('adminlte::page')

@section('title', 'Horas')

@section('content_header')
    <h1>Horas VOAE</h1>
@stop

@section('content')

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <div class="row">
        <!-- Científica -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-flask"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Científica</span>
                    <span class="info-box-number">
                        {{ $totalsByAmbito['cientifica'] ?? 0 }}
                        <!-- Badge verde si es 15 o más -->
                        @if (($totalsByAmbito['cientifica'] ?? 0) >= 15)
                            <span class="badge badge-success ml-2">Completado</span>
                        @elseif(($totalsByAmbito['cientifica'] ?? 0) == 0)
                            <!-- Badge rojo si es 0 -->
                            <span class="badge badge-danger ml-2">No Iniciado</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Cultural -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-theater-masks"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Cultural</span>
                    <span class="info-box-number">
                        {{ $totalsByAmbito['cultural'] ?? 0 }}
                        <!-- Badge verde si es 15 o más -->
                        @if (($totalsByAmbito['cultural'] ?? 0) >= 15)
                            <span class="badge badge-success ml-2">Completado</span>
                        @elseif(($totalsByAmbito['cultural'] ?? 0) == 0)
                            <!-- Badge rojo si es 0 -->
                            <span class="badge badge-danger ml-2">No Iniciado</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Deportiva -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-football-ball"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Deportiva</span>
                    <span class="info-box-number">
                        {{ $totalsByAmbito['deportiva'] ?? 0 }}
                        <!-- Badge verde si es 15 o más -->
                        @if (($totalsByAmbito['deportiva'] ?? 0) >= 15)
                            <span class="badge badge-success ml-2">Completado</span>
                        @elseif(($totalsByAmbito['deportiva'] ?? 0) == 0)
                            <!-- Badge rojo si es 0 -->
                            <span class="badge badge-danger ml-2">No Iniciado</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Social -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Social</span>
                    <span class="info-box-number">
                        {{ $totalsByAmbito['social'] ?? 0 }}
                        <!-- Badge verde si es 15 o más -->
                        @if (($totalsByAmbito['social'] ?? 0) >= 15)
                            <span class="badge badge-success ml-2">Completado</span>
                        @elseif(($totalsByAmbito['social'] ?? 0) == 0)
                            <!-- Badge rojo si es 0 -->
                            <span class="badge badge-danger ml-2">No Iniciado</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Constancias</h2>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#nuevaConstanciaModal">
            Nueva Constancia
        </button>
    </div>
    @if (session('success'))
        <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert"
            style="position: fixed; top: 20px; right: 20px; z-index: 1050; width: auto; max-width: 90%;" aria-live="polite">
            <span>{{ session('success') }}</span>
        </div>
    @endif
    <!--Fin Científica, Cultural, Deportiva, Social-->
    <table id="hora" class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th scope="col">Ámbito</th>
                <th scope="col">Archivo</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if ($hours->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No hay datos disponibles.</td>
                </tr>
            @else
                @foreach ($hours as $hour)
                    <tr>
                        <th scope="row">{{ $hour->id }}</th>
                        <td>{{ $hour->titulo }}</td>
                        <td>{{ $hour->ambito }}</td>
                        <td>
                            @if ($hour->archivo)
                                <!-- Enlace para descargar el archivo con ícono de PDF -->
                                <a href="{{ route('horas.descargar', $hour->id) }}" class="btn btn-danger btn-sm" download>
                                    <i class="bi bi-file-earmark-pdf-fill" style="color: rgb(253, 253, 253);"></i>
                                </a>
                            @else
                                No disponible
                            @endif
                        </td>

                        <td>{{ $hour->cantidad }}</td>
                        <td>
                            <a href="{{ route('horas.edit', $hour->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i> <!-- Icono de editar -->
                            </a>
                            <form action="{{ route('horas.destroy', $hour->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal">
                                    <i class="bi bi-trash"></i> <!-- Icono de eliminar -->
                                </button>
                            </form>
                        </td>

                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('horas.destroy', $hour->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="nuevaConstanciaModal" tabindex="-1" aria-labelledby="nuevaConstanciaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevaConstanciaModalLabel">Nueva Constancia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="nuevaConstanciaForm" action="{{ route('horas.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="ambito" class="form-label">Ámbito</label>
                            <select class="form-select" id="ambito" name="ambito" required>
                                <option value="" selected disabled>Seleccione un ámbito</option>
                                <option value="deportiva">Deportivo</option>
                                <option value="social">Social</option>
                                <option value="cultural">Cultural</option>
                                <option value="cientifica">Científico</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="archivo" class="form-label">Archivo</label>
                            <input type="file" class="form-control" id="archivo" name="archivo" required>
                            <small class="form-text text-muted">Tamaño máximo del archivo: 2 MB</small>
                        </div>

                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="nuevaConstanciaForm" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Cierra el alert después de 3 segundos
        setTimeout(function() {
            var alert = document.getElementById('successAlert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
            }
        }, 3000); // 3000 milisegundos = 3 segundos
    </script>

@stop


@section('js')
    @if (!$hours->isEmpty())
        <script>
            var table = new DataTable('#hora', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
                },
            });
        </script>
    @endif




@stop
