@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1>Lista Empleados</h1>
@stop

@section('content')

    <div class="row justify-content-center align-items-center g-2">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                            <th scope="col">APELLIDO</th>
                            <th scope="col">TIPO DOCUMENTO</th>
                            <th scope="col">N° DOCUMENTO</th>
                            <th scope="col">E-MAIL</th>
                            <th scope="col">CUMPLEAÑOS</th>
                            <th scope="col">ROL</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($empleados as $empleado)
                         <tr class="">
                            <td>{{$empleado->nombre}}</td>
                            <td>{{$empleado->apellido}}</td>
                            <td>{{ $modeldocumento->getNameDocument($empleado->tipo_documento_id) }}</td>
                            <td>{{$empleado->documento}}</td>
                            <td>{{$empleado->email}}</td>
                            <td>{{$empleado->fecha_nacimiento}}</td>
                            <td>{{$modeldocumento->getNameRol($empleado->rol) }}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$empleado->id}}" title="Editar">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$empleado->id}}" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('empleados.info')
                    @endforeach
                    </tbody>
                </table>
                {{$empleados->links()}}
            </div>
            @include('empleados.create')

        </div>
    </div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Menu Empleados!'); </script>
@stop
