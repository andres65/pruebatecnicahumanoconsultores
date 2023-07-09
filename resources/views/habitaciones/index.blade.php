@extends('adminlte::page')

@section('title', 'Habitaciones')

@section('content_header')
    <h1>Lista Habitaciónes</h1>
@stop

@section('content')

    <div class="row justify-content-center align-items-center g-2">

        <div class="col-md-11">
            <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                Nuevo
            </button>
            <br><br>
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">NOMBRE</th>
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
                        @include('habitaciones.info')
                    @endforeach
                    </tbody>
                </table>
                {{$habitaciones->links()}}
            </div>
            @include('habitaciones.create')

        </div>
    </div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Menu Tipo habitacion!'); </script>
@stop
