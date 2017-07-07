<script type="text/javascript" src="js/codigo.js"></script>
<br>
<br>
<br>
<div class="row">
	<div class="form-group">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<button type="button" class="btn btn-primary btn-block" name="btnnuevo" id="idbtnNuevoCodigo"><span class="glyphicon glyphicon-new-window"></span> Nuevo Codigo de Equipo</button>	
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" >
			<thead>
				<tr class="danger">
					<th>ID</th>
					<th>Codigo</th>
					<th>Descripcion</th>
					<!-- <th>fkPadre</th> -->
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(isset($listado)){
					foreach($listado as $codigo){
				?>
						<tr>
							<td><?php echo $codigo->pkcodigo ?></td>
							<td><?php echo $codigo->codigo ?></td>
							<td><?php echo $codigo->descripcion ?></td>
							<!-- <td><?php #echo $codigo->fkcodigopadre ?></td> -->
							    <?php					 
							    		echo "<td><a href='#' onclick=\"editar('" . $codigo->pkcodigo . "')\"><span class='glyphicon glyphicon-edit' data-toggle='tooltip' title='Editar'></span></a></td>";
							    		echo "<td><a disabled href='#' onclick=\"eliminar('" . $codigo->pkcodigo . "','" . $codigo->descripcion . "')\"><span class='glyphicon glyphicon-trash' data-toggle='tooltip' title='Eliminar'></span></a></td>";
							    ?>
						</tr>
		<?php	
					}
				}
		?>		
			</tbody>
		</table>	
	</div>	
</div>
