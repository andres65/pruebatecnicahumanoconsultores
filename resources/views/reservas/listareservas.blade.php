@extends('adminlte::page')

@section('title', 'ReservacionesActivas')

@section('content_header')
    <h1>Reservaciónes Activas</h1>
@stop

@section('content')

    <div class="row justify-content-center align-items-center g-2">
        <div class="col-md-11">
            <br>
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">HABITACIÓN</th>
                            <th scope="col">FECHA ENTRADA</th>
                            <th scope="col">FECHA SALIDA</th>
                            <th scope="col">DÍAS</th>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">ID CLIENTE</th>
                            <th scope="col">RESPONSABLE</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($reservas))
                            @foreach ($reservas as $reserva)
                                <tr class="">
                                    <td>{{ $modelHabitacion->getNameRoom($reserva->habitacion_id) }}</td>
                                    <td>{{$reserva->fecha_inicio}}</td>
                                    <td>{{$reserva->fecha_fin}}</td>
                                    <td>{{$reserva->dias}}</td>
                                    <td>{{ $modelCliente->getNameCustomer($reserva->cliente_id) }}</td>
                                    <td>{{ $modelCliente->getNameCustomerNumDocument($reserva->cliente_id) }}</td>
                                    <td>{{ $modelUser->getNameUser($reserva->empleado_id) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit{{$reserva->id}}" title="Reservar">
                                            <i class="fas fa-bell"></i>
                                        </button>
                                    </td>
                                </tr>
                                {{-- @include('reservas.info') --}}
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- @include('reservas.create') --}}
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


