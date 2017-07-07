	<script type="text/javascript" src="js/codigo.js"></script>
<!--AQUI SOLO TENGO NUEVE COLUMNAS PARA REPARTIR-->
	<div class="row">		
		<div class="col-sm-12">
			<center>
				<h3>CODIGO DE EQUIPO</h3>
			</center>
		</div>
	</div>
	<form class="form-horizontal" role="form">

<?php 
	$edicion = false;
	if(isset($listado)){
		$edicion = true;
		$codigo = $listado;
		$count = $codigo->getListCount();
	} ?>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="COCodigo">Codigo</label>
			<div class="col-sm-9">
				<input type="hidden" id="COPkCodigo" disabled value= "<?= ($edicion) ? $codigo->getPkCodigo() : '0'; ?>"/>
				<input type="text" maxlength="20" class="form-control" name="txtCodigo" id="COCodigo" placeholder="Codigo" onKeyUp="this.value = this.value.toUpperCase();" value= "<?= ($edicion) ? $codigo->getCodigoParcial() : '';?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="CODescripcion">Descripcion</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="txtDescripcion" id="CODescripcion" placeholder="Nombre del codigo" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $codigo->getDescripcion() : '';?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="CODCompuesto">Codigo Compuesto</label>
			<div class="col-sm-3">
				<input type="hidden" id='pkCodigoCompuesto' value = "0" >
				<input type="text" maxlength="50" class="form-control" name="CODCompuesto" id="CODCompuesto" onblur="salidafoco()" placeholder="Codigo" onKeyUp="this.value=this.value.toUpperCase();" value= ""/>
			</div>
			<label class="col-sm-4 text-left" id="CODescripcionComp">Nombre codigo</label>			
			<div class="col-sm-1">
				<button type="button" class="btn btn-success btn-block" name="COAddHoja"  id="COAddHoja"><span class="glyphicon glyphicon-plus-sign"></span></button>
			</div>
			<div class="col-sm-1">
				<button type="button" class="btn btn-danger btn-block" name="CODelHoja" id="CODelHoja"><span class="glyphicon glyphicon-minus-sign"></span></button>
			</div>			
		</div>

		<div class="form-group">
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
				<select multiple class="form-control" id="idCompuesto">
				<?php 
					$i = 0;
					while ($i < $count) {
						$h1 = $codigo->getComponent($i);
						echo "<option value = \"" . $h1->getPkCodigo() . "\">" .$h1->getCodigo() . "</option>";
						$i += 1; 
					}					
				 ?>
				</select>
			</div>			
		</div>

		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-success btn-block" name="btnGuardar"  id="COGuardar"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-danger btn-block" name="CORetornar" id="CORetornar"><span class="glyphicon glyphicon-list"></span> Retornar</button>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</form>