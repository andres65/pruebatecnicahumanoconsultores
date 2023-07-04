@extends('adminlte::page')

@section('title', 'Habitaciones')

@section('content_header')
    <h1>Reservaciónes</h1>
@stop

@section('content')

    <div class="row justify-content-center align-items-center g-2">

        <div class="col-md-11">
            <br>
            {{-- Formulario busqueda habitacion  --}}
            <form action="{{ route('reservas.buscar') }}" method="POST">
                @csrf
                <div class="form-row align-items-center">
                    <div class="col-sm-3 mb-3">
                        <label for="fecha_entrada" class="form-label">FECHA ENTRADA</label>
                        <input type="date" class="form-control @error('fecha_entrada') is-invalid @enderror" name="fecha_entrada" id="fecha_entrada" required>
                        @error('fecha_entrada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label for="fecha_salida" class="form-label">FECHA SALIDA</label>
                        <input type="date" class="form-control @error('fecha_salida') is-invalid @enderror" name="fecha_salida" id="fecha_salida" required>
                        @error('fecha_salida')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label for="num_personas" class="form-label">N° PERSONAS</label>
                        <input type="number" class="form-control" name="num_personas" id="num_personas" placeholder="Cantidad de personas" required>
                    </div>
                    <div class="col-sm-3 mb-3" style="margin-bottom: 0px !important;margin-top: 16px;">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>

            </form>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                Nuevo
            </button>
            <br><br>
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">HABITACIÓN</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">CUPO</th>
                            <th scope="col">OBSERVACIONES</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($habitaciones as $habitacion)
                         <tr class="">
                            <td>{{$habitacion->nombre}}</td>
                            @if ($habitacion->estado == 1)
                                <td>ACTIVO</td>
                            @else
                                <td>INACTIVO</td>
                            @endif
                            <td>{{$habitacion->cupo}}</td>
                            <td>{{$habitacion->observaciones}}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$habitacion->id}}" title="Editar">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$habitacion->id}}" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('reservas.info')
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('reservas.create')

        </div>
    </div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Menu Tipo habitacion!'); </script>
@stop
