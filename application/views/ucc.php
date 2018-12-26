<!doctype html>
<html lang="en">
<h1>Hola</h1>
<div id="container">
	<div id="body">
		<?php foreach ($consulta->resultado() as $fila) {
			echo $fila->Nombre;
		}
	?>
	
	</div>
</div>
