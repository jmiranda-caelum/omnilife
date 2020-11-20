@extends('layouts.menu')

@section('section')

@php
    if(isset($_REQUEST['action_msg'])){
        if($_REQUEST['action_msg'] == 'add'){
@endphp
            <script>Swal.fire('Empleado agregado!','','success')</script>
@php
        }elseif($_REQUEST['action_msg'] == 'update'){
@endphp
            <script>Swal.fire('Empleado actualizado!','','success')</script>
@php
        }elseif($_REQUEST['action_msg'] == 'Error'){
@endphp
           <script>Swal.fire('Error al intentar realizar la operación!','','error')</script>
@php
        }elseif($_REQUEST['action_msg'] == 'delete'){
@endphp
           <script>Swal.fire('Empleado eliminado!','','success')</script>
@php
        }elseif($_REQUEST['action_msg'] == 'activate'){
@endphp
           <script>Swal.fire('Empleado activado!','','success')</script>
@php
        }
    }
@endphp

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #f3f3f3;
}

.swal2-container.swal2-center {
    z-index: 10000000000000000000;
}
</style>

<div class="row wrapper border-bottom white-bg page-heading" style="margin-bottom: 30px;">
    <div class="col-lg-8">
        <h2 style="margin-top: 25px;">Empleados</h2>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            <a onclick="open_modal();" class="btn btn-primary"><i class="fa fa-plus"></i> Crear </a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content p-xl">
        <div class="row" style="overflow: auto;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="employees_table">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Salario Dolares</th>
                        <th>Salario Pesos</th>
                        <th>Correo</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees_data as $w)
                            <tr class="gradeX">
                                <td>{{ $w->codigo }}</td>
                                <td>{{ $w->nombre }}</td>
                                <td>{{ $w->salarioDolares }}</td>
                                <td>{{ $w->salarioPesos }}</td>
                                <td>{{ $w->correo }}</td>
                                <td>
                                    @php
                                            if($w->activo == 1){
                                    @endphp
                                               Activo
                                    @php
                                            }else{
                                    @endphp
                                               Inactivo
                                    @php
                                            }
                                    @endphp
                                </td>
                                
                                <td class="action-buttons">
                                    <i class="fas fa-eye edit-button" onclick="viewEmployee({{ $w->id }});"></i>
                                    <i class="fas fa-pencil-alt edit-button" onclick="updateEmployee({{ $w->id }});"></i>
                                    @php
                                            if($w->activo == 1){
                                    @endphp
                                               <i class="fas fa-trash-alt delete-button" onclick="deleteEmployee({{ $w->id }});"></i>
                                    @php
                                            }else{
                                    @endphp
                                               <i class="fas fa-check-circle success-button" style="cursor: pointer;" onclick="activateEmployee({{ $w->id }});"></i>
                                    @php
                                            }
                                    @endphp                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal CRUD Employees-->
  <div class="modal fade" id="employee_modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title" id="employee_title"></h2>
        </div>
        <div class="modal-body">
            <div class="col-lg-12" style="margin-bottom: 60px;">
                <form role="form" method="post" action="{{ url ('add_employees') }}" id="form_employees">
                    @csrf
                    <input type="hidden" name="action" value="1">
                    <input type="hidden" name="idemployee" id="idemployee">
                    <div class="col-lg-6">
                        <div class="form-group">
                           <label>*Codigo:</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" maxlength="40" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>*Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" maxlength="120" required autocomplete="off">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>*Salario Dolares:</label>
                            <input type="text" name="salarioDolares" id="salarioDolares" class="form-control" required autocomplete="off" onblur="currencyrate();">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                           <label>*Salario Pesos:</label>
                            <input type="text" name="salarioPesos" id="salarioPesos" class="form-control" required autocomplete="off" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                           <label>*Direccion:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" maxlength="250" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>*Ciudad:</label>
                            <input type="text" name="ciudad" id="ciudad" class="form-control" maxlength="50" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>*Estado:</label>
                            <input type="text" name="estado" id="estado" class="form-control" maxlength="50" required autocomplete="off">
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                           <label>*Telefono:</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" maxlength="10" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>*Correo:</label>
                            <input type="text" name="correo" id="correo" class="form-control" maxlength="100" required autocomplete="off">
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group" style="margin-bottom: 40px;">
                            <label>Estatus: </label>
                            <label style="display: none;" id="radio_text">Inactivo</label>
                            <div id="status_button">
                                <label class="radio-inline">
                                    <input type="radio" name="activo" id="status1" value="1" checked>Activo
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="activo" id="status2" value="0">Inactivo
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <a onclick="reset_fields();" class="btn btn-danger" style="float: left;margin-right: 10px;"  data-dismiss="modal">Cancelar</a>
                        <a onclick="submit_form();" class="btn btn-success" style="float: right;margin-right: 10px;">Aceptar</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer" style="display: contents;">
        </div>
      </div>
    </div>
  </div>

<!-- Modal VIEW Employees-->
  <div class="modal fade" id="view_employee_modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Detalle de empleado</h2>
        </div>
        <div class="modal-body">
            <div class="col-lg-12" style="margin-bottom: 60px;">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">código</label>
                        <h3 id="codigo_view"></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">nombre</label>
                        <h3 id="nombre_view"></h3>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">salario dorales</label>
                        <h3 id="salarioDolares_view"></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">salario pesos</label>
                        <h3 id="salarioPesos_view"></h3>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">direccion</label>
                        <h3 id="direccion_view"></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">estado</label>
                        <h3 id="estado_view"></h3>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">ciudad</label>
                        <h3 id="ciudad_view"></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">telefono</label>
                        <h3 id="telefono_view"></h3>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">correo</label>
                        <h3 id="correo_view"></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">status</label>
                        <h3 id="activo_view"></h3>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">borrado el</label>
                        <h3 id="deleted_view"></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">creado el</label>
                        <h3 id="created_view"></h3>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="title_view">ultima actualización</label>
                        <h3 id="updated_view"></h3>
                    </div>
                </div>

                <div class="col-lg-12">
                    <h4>Proyección</h4>
                    <table style="margin-bottom: 30px;">
                      <tr>
                        <th>Moneda</th>
                        <th>0</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                      </tr>
                      <tr id="dolar_proyection">
                      </tr>
                      <tr id="pesos_proyection">
                      </tr>
                    </table>
                </div>
                
                <div class="col-lg-12">
                    <a class="btn btn-danger" style="float: right;margin-right: 10px;"  data-dismiss="modal">Cerrar</a>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="display: contents;">
        </div>
      </div>
    </div>
  </div>

<script>
    $(document).ready(function(){
        window.history.pushState("", "", "{{ url ('home') }}");

        $('#employees_table').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ],
            "order": [[ 0, "desc" ]],
            lengthMenu: [10, 20, 50, 100],
        });

   });

    function open_modal(){
        reset_fields();
        $('#employee_title').html('Crear empleado');
        $('#employee_modal').modal('show');
    }

    function reset_fields(){
        $('#idemployee').val('');
        $('#codigo').val('');
        $('#nombre').val('');
        $('#salarioPesos').val('');
        $('#salarioDolares').val('');
        $('#direccion').val('');
        $('#estado').val('');
        $('#ciudad').val('');
        $('#telefono').val('');
        $('#correo').val('');
        $("#status1").prop("checked", true);
        $("#status2").prop("checked", false);
    }

    function updateEmployee(id){
        reset_fields();
        $('#title_new').html('Modificar empleado');
        var data;

        $.ajax({
            type: "POST",
            url: "{{ url ('update_employees') }}",
            dataType: 'text',
            data: {
                id: id,
                action: 1,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                data = JSON.parse(response);
                if (typeof data !== 'undefined') {
                    $('#idemployee').val(data.employee_data_json.id);
                    $('#codigo').val(data.employee_data_json.codigo);
                    $('#nombre').val(data.employee_data_json.nombre);
                    $('#salarioPesos').val(data.employee_data_json.salarioPesos);
                    $('#salarioDolares').val(data.employee_data_json.salarioDolares);
                    $('#direccion').val(data.employee_data_json.direccion);
                    $('#estado').val(data.employee_data_json.estado);
                    $('#ciudad').val( data.employee_data_json.ciudad);
                    $('#telefono').val(data.employee_data_json.telefono);
                    $('#correo').val(data.employee_data_json.correo);

                    if (data.employee_data_json.activo == '1') {
                        $("#status1").prop("checked", true);
                        $("#status2").prop("checked", false);
                    }else{
                        $("#status1").prop("checked", false);
                        $("#status2").prop("checked", true);
                    }
                    $('#employee_modal').modal('show');
                    
                }else{
                    Swal.fire('','Error al cargar.','error');
                    reset();
                }
            }
        });
    }

    function checkCode(code){
       
        $.ajax({
            type: "POST",
            url: "{{ url ('check_code') }}",
            dataType: 'text',
            data: {
                code: code,
                action: 1,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response == 1) {
                    Swal.fire('','Este código se encuentra en uso','warning');
                    return;
                }
            }
        });
    }

    function deleteEmployee(id){
        Swal.fire({
          title: 'Estas seguro?',
          text: "",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, borrar!',
          cancelButtonText: 'Cancelar',
          heightAuto : false
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "POST",
                url: "{{ url ('del_employee') }}",
                dataType: 'text',
                data: {
                    id: id,
                    action: 1,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href = window.location.href + "?action_msg=delete";
                }
            });
          }
        });
    }

    function activateEmployee(id){
        Swal.fire({
          title: 'Estas seguro?',
          text: "",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, activar!',
          cancelButtonText: 'Cancelar',
          heightAuto : false
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "POST",
                url: "{{ url ('act_employee') }}",
                dataType: 'text',
                data: {
                    id: id,
                    action: 1,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href = window.location.href + "?action_msg=activate";
                }
            });
          }
        });
    }

    function currencyrate(){

        var result;
        var dolares = $('#salarioDolares').val();
        if (isNaN(dolares)) { 
            Swal.fire('Solo dígitos','','error');
            $('#salarioDolares').val('')
            return;
        }

        $.ajax({
            type: "POST",
            url: "{{ url ('get_rate') }}",
            dataType: 'text',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                data = JSON.parse(response);
                if (typeof data !== 'undefined') {

                    result = dolares * data.bmx.series[0].datos[0].dato;
                    $('#salarioPesos').val(result.toFixed(2));
                    
                }else{
                    Swal.fire('','Error al cargar.','error');
                    reset();
                }
            }
        });
    }

    function viewEmployee(id){
        view_reset_fields();
        var data;
        var dolares, pesos;
        var dolares_rows, pesos_rows;

        $.ajax({
            type: "POST",
            url: "{{ url ('update_employees') }}",
            dataType: 'text',
            data: {
                id: id,
                action: 1,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                data = JSON.parse(response);
                if (typeof data !== 'undefined') {
                    $('#codigo_view').html(data.employee_data_json.codigo);
                    $('#nombre_view').html(data.employee_data_json.nombre);
                    $('#salarioPesos_view').html(data.employee_data_json.salarioPesos);
                    $('#salarioDolares_view').html(data.employee_data_json.salarioDolares);
                    $('#direccion_view').html(data.employee_data_json.direccion);
                    $('#estado_view').html(data.employee_data_json.estado);
                    $('#ciudad_view').html( data.employee_data_json.ciudad);
                    $('#telefono_view').html(data.employee_data_json.telefono);
                    $('#correo_view').html(data.employee_data_json.correo);
                    $('#deleted_view').html(data.employee_data_json.deleted_at);
                    $('#created_view').html(data.employee_data_json.created_at);
                    $('#updated_view').html(data.employee_data_json.updated_at);

                    if (data.employee_data_json.activo == '1') {
                        $('#activo_view').html('Activo');
                    }else{
                        $('#activo_view').html('Inctivo');
                    }

                    if (data.employee_data_json.salarioDolares == null) {
                        dolares = 0;
                    }else{
                        dolares = data.employee_data_json.salarioDolares;
                    }

                    if (data.employee_data_json.salarioPesos == null) {
                        pesos = 0;
                    }else{
                        pesos = data.employee_data_json.salarioPesos;
                    }

                    dolares_rows = '<td>Dolares</td>'
                    pesos_rows = '<td>Pesos</td>'

                    for (var i = 0; i < 7; i++) {

                        dolares_rows += '<td>'+dolares.toFixed(2)+'</td>';
                        pesos_rows += '<td>'+pesos.toFixed(2)+'</td>';
                        dolares = dolares * 1.03;
                        pesos = pesos * 1.03;
                    }

                    $('#dolar_proyection').html(dolares_rows);
                    $('#pesos_proyection').html(pesos_rows);



                    $('#view_employee_modal').modal('show');
                    
                }else{
                    Swal.fire('','Error al cargar.','error');
                    reset();
                }
            }
        });
    }

    function view_reset_fields(){
        $('#idemployee_view').html('');
        $('#codigo_view').html('');
        $('#nombre_view').html('');
        $('#salarioPesos_view').html('');
        $('#salarioDolares_view').html('');
        $('#direccion_view').html('');
        $('#estado_view').html('');
        $('#ciudad_view').html('');
        $('#telefono_view').html('');
        $('#correo_view').html('');
        $('#activo_view').html('');
    }
</script>
@endsection
