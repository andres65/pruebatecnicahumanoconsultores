@extends('adminlte::page')

@section('title', 'Tipo Documento')

@section('content_header')
    <h1>Lista Tipo Documento</h1>
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
                            <th scope="col">OBSERVACIONES</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($tipoDocumento as $Documento)
                         <tr class="">
                            <td>{{$Documento->nombre}}</td>
                            @if ($Documento->estado == 1)
                                <td style="color: green;">ACTIVO</td>
                            @else
                                <td style="color: red;">INACTIVO</td>
                            @endif
                            <td>{{$Documento->observaciones}}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$Documento->id}}" title="Editar">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$Documento->id}}" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('tipo_documento.info')
                    @endforeach
                    </tbody>
                </table>
                {{$tipoDocumento->links()}}
            </div>
            @include('tipo_documento.create')

        </div>
    </div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Menu Tipo Documento!'); </script>
@stop
