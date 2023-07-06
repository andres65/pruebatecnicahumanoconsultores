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

        <form method="POST" action="{{ url('/reservas-createcliente/') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
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

                <div id="searchResults{{$available->id}}">
                    <!-- Aquí se mostrarán los resultados de búsqueda -->
                </div>
                <div id="searchMessage{{$available->id}}">
                    <!-- Aquí se mostrará el mensaje si no se encuentran resultados -->
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
                        <input type="date"
                            class="form-control" name="fecha_nacimientocliente" id="" aria-describedby="helpId" placeholder="" >
                        </div>
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

