<script type="text/javascript" src="js/estadoequipo.js"></script>
<br>
<br>
<br>
<center><h1>ESTADO ACTUAL DE EQUIPOS</h1></center>
<div class="row">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" >
			<thead>
				<tr class="danger">
					<th>Equipo</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th>Motivo</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(isset($listado)){
					foreach($listado as $estadoEquipo){
				?>
						<tr>
							<td><?php echo $estadoEquipo->codigo ?></td>
							<td><?php echo $estadoEquipo->fecha ?></td>
							<td><?php echo $estadoEquipo->estado ?></td>
							<td><?php echo $estadoEquipo->motivo ?></td>
							    <?php					 
							    		echo "<td><a href='#' onclick=\"editar('" . $estadoEquipo->fkequipo . "')\"><span class='glyphicon glyphicon-edit' data-toggle='tooltip' title='Editar'></span></a></td>";
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
