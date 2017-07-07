<script type="text/javascript" src="js/estadoequipo.js"></script>
<!--AQUI SOLO TENGO NUEVE COLUMNAS PARA REPARTIR-->
	<div class="row">		
		<div class="col-sm-12">
			<center>
				<h3>ESTADO ACTUAL DE EQUIPO</h3>
			</center>
		</div>
	</div>
	<form class="form-horizontal" role="form">

<?php 
	$edicion = false;
	if(isset($listado)){
		$edicion = true;
		$estadoEquipo = $listado;

	} ?>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="ESCodigo">Codigo Equipo</label>
			<div   class="col-sm-9" >
				<input type="text" class="form-control" name="ESCodigo" id="ESCodigo" disabled value= "<?= ($edicion) ? $estadoEquipo->codigo : '0'; ?>"/>
			<input type="hidden" id = "ESFkEquipo" value = "<?= ($edicion) ? $estadoEquipo->fkequipo : '0';?>"/>	
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="ESFecha">Fecha</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="ESFecha" id="ESFecha" data-date-format="DD-MM-YYYY" value= "<?= ($edicion) ? $estadoEquipo->fecha : date('d-m-Y'); ?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="ESMotivo">Motivo</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="ESMotivo" id="ESMotivo" placeholder="Describa el motivo de cambio de estado" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $estadoEquipo->motivo : '';?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="ESMotivo">Responsable</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="ESPersonal" id="ESPersonal" placeholder="Responsable" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $estadoEquipo->personal : '';?>"/>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="ESEstado">Estado de Equipo</label>
			<div class="col-sm-3">
				<select class="form-control" name="ESEstado" id="ESEstado" onchange="validarEstado()">
				<?php 
					if($edicion){
						foreach ($estados as $estado) {
							if($estado->codigo == $estadoEquipo->estado){
								echo"<option selected value=\"" . $estado->codigo . "\">" . $estado->descripcion . "</option>";
							}else{
								echo"<option value=\"" . $estado->codigo . "\">" . $estado->descripcion . "</option>";
							}
						}
					}
				?>
				</select>
			</div>
			<label class="col-sm-6 text-left" id="IDError">sin error</label>
		</div>
		
		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-success btn-block" name="ESGuardar"  id="ESGuardar"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-danger btn-block" name="ESRetornar" id="ESRetornar"><span class="glyphicon glyphicon-list"></span> Retornar</button>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</form>