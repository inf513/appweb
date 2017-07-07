<?php

	$Configure = Config::singleton();

	$Configure->set('ControllersFolder','Controladores/');
	$Configure->set('ModelsFolder','Modelos/');
	$Configure->set('ViewsFolder','Vistas/');

	//$Configure->set('dbhost', '200.87.51.3');
	$Configure->set('dbhost', 'localhost');

	//$Configure->set('dbname', 'db_grupo06');
	$Configure->set('dbname', 'dbsiagro');

	//$Configure->set('dbuser', 'grupo06');
	$Configure->set('dbuser', 'openpg');

	//$Configure->set('dbpass', 'grupo06grupo06');
	$Configure->set('dbpass', 'openpgpwd');
?>
