@extends('adminlte::page')

@section('title', 'Habitaciones')

@section('content_header')
    <h1>Reservaciónes</h1>
@stop

@section('content')

    <div class="row justify-content-center align-items-center g-2">

        {{-- Formulario busqueda habitacion  --}}
            <form action="{{ route('reservas.buscar') }}" method="POST"  class="col-md-11">
            <br>
                @csrf
                <div class="form-row align-items-center">
                    <div class="col-md-4">
                        <label for="fecha_entrada" class="form-label">FECHA ENTRADA</label>
                        <input type="date" class="form-control @error('fecha_entrada') is-invalid @enderror" name="fecha_entrada" id="fecha_entrada" value="{{ isset($fechaInicio) ? $fechaInicio : '' }}" required>
                        @error('fecha_entrada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="fecha_salida" class="form-label">FECHA SALIDA</label>
                        <input type="date" class="form-control @error('fecha_salida') is-invalid @enderror" name="fecha_salida" id="fecha_salida" value="{{ isset($fechaFin) ? $fechaFin : '' }}" required>
                        @error('fecha_salida')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="num_personas" class="form-label">N° PERSONAS</label>
                        <input type="number" class="form-control" name="num_personas" id="num_personas" placeholder="Cantidad de personas" value="{{ isset($cupo) ? $cupo : '' }}" required>
                    </div>
                    <div class="col-md-2" style="margin-bottom: 0px !important;margin-top: 28px;">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" style="padding-top: 3px;padding-bottom: 3px;">Buscar</button>
                    </div>
                </div>
            </form>
        <div class="col-md-11">
            <br>
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">HABITACIÓN</th>
                            <th scope="col">CUPO</th>
                            <th scope="col">OBSERVACIONES</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($availables))
                            @foreach ($availables as $available)
                                <tr class="">
                                    <td>{{$available->nombre}}</td>
                                    <td>{{$available->cupo}}</td>
                                    <td>{{$available->observaciones}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$available->id}}" title="Editar">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$available->id}}" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                {{-- @include('reservas.info') --}}
                            @endforeach
                        @endif
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
    <script> console.log('Menu Reservas!'); </script>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Previene el envío del formulario
console.log('entro aqui ');
        // Obtén los valores de las fechas de inicio y fin
        var fechaInicio = document.getElementById('fecha_inicio').value;
        var fechaFin = document.getElementById('fecha_fin').value;

        // Actualiza la URL de la acción del formulario con los valores de las fechas
        this.action = this.action + '?fecha_inicio=' + fechaInicio + '&fecha_fin=' + fechaFin;

        // Envía el formulario
        this.submit();
    });
</script>

@stop
