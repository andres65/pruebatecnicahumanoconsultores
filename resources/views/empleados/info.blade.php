<!-- Modal -->
<div class="modal fade" id="edit{{$empleado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR EMPLEADO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       <form method="POST" action="{{ url('/empleados/' . $empleado->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
            <div class="modal-body">

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                    <label for="" class="form-label">NOMBRE</label>
                    <input type="text"
                        class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="" value="{{$empleado->nombre}}" minlength="3" required>
                    </div>
                    <div class="col-md-6 mb-3">
                    <label for="" class="form-label">APELLIDOS</label>
                    <input type="text"
                        class="form-control" name="apellido" id="" aria-describedby="helpId" placeholder="" value="{{$empleado->apellido}}" minlength="3" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">TIPO DOCUMENTO</label>
                        <select class="form-control" name="tipo_documento_id" id="tipo_documento_id">
                            @foreach ($tipoDocumento as $Documento)
                                <option value='{{$Documento->id}}'@selected($modeldocumento->getNameDocument($empleado->tipo_documento_id) == $Documento->nombre)>{{$Documento->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for="" class="form-label">N° DOCUMENTO</label>
                    <input type="text"
                        class="form-control" name="documento" id="" aria-describedby="helpId" placeholder="" value="{{$empleado->documento}}" minlength="5" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">E-MAIL</label>
                    <input type="email"
                    class="form-control" name="email" id="" aria-describedby="helpId" placeholder="" value="{{$empleado->email}}" minlength="5" required>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                    <label for="" class="form-label">CUMPLEAÑOS</label>
                    <input type="date"
                        class="form-control" name="fecha_nacimiento" id="" aria-describedby="helpId" placeholder="" value="{{$empleado->fecha_nacimiento}}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for="" class="form-label">ROL</label>
                        <select class="form-control" name="rol" id="rol">
                            <option value='1'@selected("1" == $empleado->rol)>ADMINISTRADOR</option>
                            <option value='2'@selected("2" == $empleado->rol)>EMPLEADO</option>
                            <option value='3'@selected("3" == $empleado->rol)>CLIENTE</option>
                        </select>
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





<!-- Modal Eliminar -->
<div class="modal fade" id="delete{{$empleado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ELIMINAR EMPLEADO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" action="{{ url('/empleados' . '/' . $empleado->id) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <div class="modal-body">
                Esta seguro de eliminar a <strong>{{$empleado->nombre}} {{$empleado->apellido}}</strong> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form>
    </div>
  </div>
</div>

