<!-- Modal -->
<div class="modal fade" id="edit{{$available->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">RESERVAR HABITACION - <strong> {{$available->nombre}} </strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form method="POST" action="{{ route('reservas.guardarcliente') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">

                <div class="form-group">
                    <div class="form-row">
                        <label for="searchInput" style="text-align: center;">BUSCAR CLIENTE POR N° DE IDENTIFICACIÓN</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control searchInput" placeholder="Ingrese identificación del cliente">
                            <input type="text" class="idmodal" value="{{$available->id}}" hidden>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btnBuscar">Buscar</button>
                        </div>
                    </div>
                </div>

                <!-- Aquí se mostrarán los resultados de búsqueda -->
                <div id="searchResults{{$available->id}}" style="display: none;">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">CLIENTE</label>
                            <input type="text" class="form-control" name="clientereserva" id="clientereserva{{$available->id}}" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">IDENTIFICACIÓN</label>
                            <input type="text" class="form-control" name="identificacionclientereserva" id="identificacionclientereserva{{$available->id}}" disabled>
                        </div>
                        <input type="text" class="form-control" name="idcliente" id="idcliente{{$available->id}}" hidden>
                    </div>
                </div>

                <!-- Aquí se mostrará el mensaje si no se encuentran resultados -->
                <div id="searchMessage{{$available->id}}" style="display: none;">

                </div>

                <!-- Formulario para agrear nuevo cliente -->
                <div id="modal-cliente{{$available->id}}" style="display: none;">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                        <label for="" class="form-label">NOMBRE</label>
                        <input type="text"
                            class="form-control" name="nombrecliente" id="" aria-describedby="helpId" placeholder="" minlength="3" >
                        </div>
                        <div class="col-md-6 mb-3">
                        <label for="" class="form-label">APELLIDOS</label>
                        <input type="text"
                            class="form-control" name="apellidocliente" id="" aria-describedby="helpId" placeholder="" minlength="3" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">TIPO DOCUMENTO</label>
                            <select class="form-control" name="tipo_documento_id" id="tipo_documento_id">
                                @foreach ($tipoDocumento as $Documento)
                                    <option value='{{$Documento->id}}'>{{$Documento->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                        <label for="" class="form-label">N° DOCUMENTO</label>
                        <input type="text"
                            class="form-control" name="documentocliente" id="" aria-describedby="helpId" placeholder="" minlength="5" >
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">E-MAIL</label>
                            <input type="email"
                            class="form-control" name="emailcliente" id="" aria-describedby="helpId" placeholder="" minlength="5" >
                        </div>

                        <div class="col-md-6 mb-3">
                        <label for="" class="form-label">CUMPLEAÑOS</label>
                        <input type="date" class="form-control" name="fecha_nacimientocliente" id="" aria-describedby="helpId" placeholder="" >
                        </div>
                    </div>
                    <div class="form-row">
                        <input type="text" class="form-control" name="idhabitacion" id=""  value="{{$available->id}}" hidden>
                        <input type="text" class="form-control" name="fechaInicio" id=""  value="{{$fechaInicio}}" hidden>
                        <input type="text" class="form-control" name="fechaFin" id="" value="{{$fechaFin}}" hidden>
                        <input type="text" class="form-control" name="idclientereserva" id="idclientereserva{{$available->id}}" hidden>
                    </div>
                    <hr>
                </div>
                <!-- FIN -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Reservar Habitación</button>
            </div>
        </form>
    </div>
  </div>
</div>

@section('js')
    <script> console.log('Menu Reservas!'); </script>
    <script>
        $(document).ready(function() {
            console.log('READY!');
            // Manejar el evento de clic en el botón "Buscar"
            $(document).on('click', '.btnBuscar', function(event) {
                event.preventDefault();
                // Obtener el valor de búsqueda dentro del modal actual
                var searchTerm = $(this).closest('.modal-content').find('.searchInput').val();
                var idmodal = $(this).closest('.modal-content').find('.idmodal').val();

                // Realizar una llamada AJAX para buscar clientes
                $.ajax({
                url: '/reservas-buscarcliente',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { search: searchTerm },
                success: function(response) {

                    if (response.length > 0) {

                        //Ocultar formulario de crear cliente
                        var modalCliente = document.getElementById('modal-cliente'+idmodal);
                        modalCliente.style.display = 'none';

                        //Ocultar div de mensaje cuando no se encuentran resultados
                        var modalSearchMessage = document.getElementById('searchMessage'+idmodal);
                        modalSearchMessage.style.display = 'none';

                        //Mostrar formulario de resultados
                        var modalSearchResults = document.getElementById('searchResults'+idmodal);
                        modalSearchResults.style.display = 'block';

                        // Mostrar los nuevos resultados
                        response.forEach(function(cliente) {

                            // Obtener referencia a los elementos input por su ID
                            document.getElementById('idclientereserva'+idmodal).value=cliente.id;
                            document.getElementById('clientereserva'+idmodal).value=cliente.nombre;
                            document.getElementById('identificacionclientereserva'+idmodal).value=cliente.documento;
                            document.getElementById('idcliente'+idmodal).value=cliente.id;
                        });


                    } else {
                        // vaciar el value del id del cliente
                        document.getElementById('idclientereserva'+idmodal).value=0;

                        //Oculta formulario de resultados
                        var modalSearchResults = document.getElementById('searchResults'+idmodal);
                        modalSearchResults.style.display = 'none';

                        // Mostrar mensaje si no se encuentran resultados
                        var modalSearchMessage = document.getElementById('searchMessage'+idmodal);
                        modalSearchMessage.style.display = 'block';

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

                //ocultar formulario de crear cliente
                var modalCliente = document.getElementById('modal-cliente'+idmodal);
                modalCliente.style.display = 'none';

                //Oculta formulario de resultados
                var modalSearchResults = document.getElementById('searchResults'+idmodal);
                modalSearchResults.style.display = 'none';

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

