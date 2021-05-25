<?php 

include_once 'php/conexion.php';

$query = $conexion->query("SELECT cedula, nombres AS nombre, apellidos AS apellido, correo, telefono, tipo_contrato AS contrato, salario, estado FROM empleado");
$empleados = $query->fetchAll(PDO::FETCH_OBJ);

?>    
    
    <div class="container" style="min-height: 70vh;">
        <h2>Empleados</h2>
        <button class="btn btn-primary my-3" data-toggle="modal" data-target="#agregarEmpleado">Agregar Empleado</button>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Contrato</th>
                    <th>Salario COP</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody id="listaEmpleados">
                <?php foreach ($empleados as $empleado) { ?>
                <tr>
                    <td class="td-cedula"><?php echo $empleado->cedula ?></td>
                    <td class="td-nombre"><?php echo $empleado->nombre ?></td>
                    <td class="td-apellido"><?php echo $empleado->apellido ?></td>
                    <td class="td-correo"><?php echo $empleado->correo ?></td>
                    <td class="td-telefono"><?php echo $empleado->telefono ?></td>
                    <td class="td-contrato"><?php echo $empleado->contrato ?></td>
                    <td class="td-salario"><?php echo $empleado->salario ?></td>
                    <td class="td-estado"><?php echo $empleado->estado ?></td>
                    <td><button class="btn btn-primary editar" data-toggle="modal" data-target="#actualizarEmpleado">Editar</button></td>
                    <td><button class="btn btn-danger eliminar">Eliminar</button></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Agregar Empleado -->
    <div class="modal fade" id="agregarEmpleado" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="cedula">Cédula</label>
                            <input name="cedula" type="number" id="cedula" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input name="nombre" type="text" id="nombre" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido">Apellido</label>
                            <input name="apellido" type="text" id="apellido" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="correo">Correo</label>
                            <input name="correo" type="email" id="correo" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefono">Teléfono</label>
                            <input name="telefono" type="number" id="telefono" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contrato">Contrato</label>
                            <select class="form-control" name="contrato" id="contrato">
                                <option value="fijo">Fijo</option>
                                <option value="temporal">Temporal</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="salario">Salario (COP)</label>
                            <input name="salario" type="number" id="salario" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btnAgregar" type="submit" class="btn btn-success" data-dismiss="modal">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Actualizar Empleado -->
    <div class="modal fade" id="actualizarEmpleado" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Actnombre">Nombre</label>
                            <input name="nombre" type="text" id="Actnombre" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Actapellido">Apellido</label>
                            <input name="apellido" type="text" id="Actapellido" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="Actcorreo">Correo</label>
                            <input name="correo" type="email" id="Actcorreo" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Acttelefono">Teléfono</label>
                            <input name="telefono" type="number" id="Acttelefono" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Actcontrato">Contrato</label>
                            <select class="form-control" name="contrato" id="Actcontrato">
                                <option value="fijo">Fijo</option>
                                <option value="temporal">Temporal</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="Actsalario">Salario (COP)</label>
                            <input name="salario" type="number" id="Actsalario" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Actestado">Estado</label>
                            <select class="form-control" name="estado" id="Actestado">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btnEditar" type="submit" class="btn btn-success" data-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>