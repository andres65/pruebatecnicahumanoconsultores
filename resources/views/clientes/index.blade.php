@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Lista Clientes</h1>
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
                            <th scope="col">APELLIDO</th>
                            <th scope="col">TIPO DOCUMENTO</th>
                            <th scope="col">N° DOCUMENTO</th>
                            <th scope="col">E-MAIL</th>
                            <th scope="col">CUMPLEAÑOS</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($clientes as $cliente)
                         <tr class="">
                            <td>{{$cliente->nombre}}</td>
                            <td>{{$cliente->apellido}}</td>
                            <td>{{ $modeldocumento->getNameDocument($cliente->tipo_documento_id) }}</td>
                            <td>{{$cliente->documento}}</td>
                            <td>{{$cliente->email}}</td>
                            <td>{{$cliente->fecha_nacimiento}}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$cliente->id}}" title="Editar">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$cliente->id}}" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('clientes.info')
                    @endforeach
                    </tbody>
                </table>
                {{$clientes->links()}}
            </div>
            @include('clientes.create')

        </div>
    </div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Menu Clientes!'); </script>
@stop
