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
                        <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_cliente">
                Nuevo
            </button>
            <br><br>
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
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit{{$available->id}}" title="Reservar">
                                            <i class="fas fa-bell"></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('reservas.info')
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- @include('reservas.create') --}}
            @include('reservas.create_cliente')

        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Menu Reservas!'); </script>
    <script>
        $(document).ready(function() {
            console.log('READY!');
            // Manejar el evento de clic en el botón "Buscar"

            $(document).on('click', '.btnBuscar', function() {
                //var searchTerm = $('#searchInput').val();
                // Obtener el valor de búsqueda dentro del modal actual
                var searchTerm = $(this).closest('.modal-content').find('.searchInput').val();
                var idmodal = $(this).closest('.modal-content').find('.idmodal').val();

                // Realizar una llamada AJAX para buscar clientes
                $.ajax({
                url: '/reservas-buscarcliente', // Reemplaza esto con la ruta real a tu función de búsqueda en Laravel
                method: 'GET',
                data: { search: searchTerm },
                dataType: 'json',
                success: function(response) {
                    // Limpiar los resultados anteriores
                    $('#searchResults'+idmodal).empty();
                    $('#searchMessage'+idmodal).empty();

                    if (response.length > 0) {

                        //ocultar formulario de crear cliente
                        var modalCliente = document.getElementById('modal-cliente'+idmodal);
                        modalCliente.style.display = 'none';

                        // Mostrar los nuevos resultados
                        response.forEach(function(cliente) {

                            var clienteHtml = '<div class="form-row">' +
                                                '<div class="col-md-6 mb-3">' +
                                                    '<label for="" class="form-label">CLIENTE</label>' +
                                                    '<input type="text" class="form-control" name="clientereserva" id="cliente" aria-describedby="helpId" value="' +
                                                    cliente.nombre +
                                                    '" >' +
                                                '</div>' +
                                                '<div class="col-md-6 mb-3">' +
                                                    '<label for="" class="form-label">IDENTIFICACIÓN</label>' +
                                                    '<input type="text" class="form-control" name="identificacionclientereserva" id="identificacion" aria-describedby="helpId" value="' +
                                                    cliente.documento +
                                                    '" >' +
                                                '</div>' +
                                                '<input type="text" class="form-control" name="idcliente" id="idclientereserva" aria-describedby="helpId" value="' +
                                                    cliente.id +
                                                    '" hidden>' +
                                            '</div>';

                            $('#searchResults'+idmodal).append(clienteHtml);
                        });

                    } else {
                        // Mostrar mensaje si no se encuentran resultados
                        var mensajeHtml = '<p style="color: red;">No se encontraron resultados.</p>' + '<hr>' +
                                            '<h5 style="text-align: center;"><strong>AGREGAR NUEVO CLIENTE</strong></h5>';
                        $('#searchMessage'+idmodal).html(mensajeHtml);

                        // mostrar formulario para agregar nuevo cliente
                        var modalCliente = document.getElementById('modal-cliente'+idmodal);
                        modalCliente.style.display = 'block';
                    }
                }
                });
            });

            // Evento que se activa al cerrar cualquier modal
            $(document).on('hidden.bs.modal', '.modal', function() {
                // Restablecer los campos de búsqueda del modal actual
                var idmodal = $(this).find('.idmodal').attr('value');
                $(this).find('.searchInput').val('');

                // Restablecer los resultados y el mensaje del modal actual
                $(this).find('#searchResults'+idmodal).empty();
                $(this).find('#searchMessage'+idmodal).empty();

                //ocultar formulario de crear cliente
                var modalCliente = document.getElementById('modal-cliente'+idmodal);
                modalCliente.style.display = 'none';
            });

        });
</script>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Previene el envío del formulario

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
