<!-- Modal -->
<div class="modal fade" id="create_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR CLIENTE RESERVA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="POST" action="{{ url('/reservas-createcliente/') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ method_field('POST') }}
                {{ csrf_field() }}

            <div class="modal-body">

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                    <label for="" class="form-label">NOMBRE</label>
                    <input type="text"
                        class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="" minlength="3" required>
                    </div>
                    <div class="col-md-6 mb-3">
                    <label for="" class="form-label">APELLIDOS</label>
                    <input type="text"
                        class="form-control" name="apellido" id="" aria-describedby="helpId" placeholder="" minlength="3" required>
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
                        class="form-control" name="documento" id="" aria-describedby="helpId" placeholder="" minlength="5" required>
                    </div>
                </div>

                <div class="form-row">

                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">E-MAIL</label>
                        <input type="email"
                        class="form-control" name="email" id="" aria-describedby="helpId" placeholder="" minlength="5" required>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for="" class="form-label">CUMPLEAÑOS</label>
                    <input type="date"
                        class="form-control" name="fecha_nacimiento" id="" aria-describedby="helpId" placeholder="" required>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
  </div>
</div>
