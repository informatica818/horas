@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
   <h1></h1>
@stop

@section('content')
  <!-- Formulario de edición con estilo de card -->
<div class="card card-primary col-md-12">
    <div class="card-header">
        <h3 class="card-title">Editar Constancia</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('horas.update', $hora->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="card-body col-md-12">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $hora->titulo }}" required>
            </div>

            <div class="form-group">
                <label for="ambito">Ámbito</label>
                <select class="form-control" id="ambito" name="ambito" required>
                    <option value="" disabled>Seleccione un ámbito</option>
                    <option value="deportiva" {{ $hora->ambito == 'deportiva' ? 'selected' : '' }}>Deportivo</option>
                    <option value="social" {{ $hora->ambito == 'social' ? 'selected' : '' }}>Social</option>
                    <option value="cultural" {{ $hora->ambito == 'cultural' ? 'selected' : '' }}>Cultural</option>
                    <option value="cientifica" {{ $hora->ambito == 'cientifica' ? 'selected' : '' }}>Científico</option>
                </select>
            </div>

            <div class="form-group">
                <label for="archivo">Archivo</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="archivo" name="archivo">
                        <label class="custom-file-label" for="archivo">Elegir archivo</label>
                    </div>
                </div>
                <small class="form-text text-muted ">Tamaño máximo del archivo: 300 kb</small>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $hora->cantidad }}" required>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <!-- Botón de cancelar que redirige a la lista de horas o a otra página -->
            <a href="{{ route('horas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>


@stop

@section('css')
   
@stop

@section('js')
    
@stop