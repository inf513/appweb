<?php
/**
* Clase Base de los controladores que contiene una vista
* donde se mostraran los datos generados por el controlador
*
**/
abstract class ControllerBase{

	private $config;

	function __construct(){

	}
	/**
	 * Metodo que renderiza la plantilla
	 *
	 * @param [type] $name nombre de la plantilla a renderizar
	 * @param [type] $vars array de variables
	 * @return
	 */
	public function show($name, $vars){
		$config = Config::singleton();
		$path = $config->get('ViewsFolder') . $name;
		
		if (file_exists($path) == false) {
			trigger_error('Plantilla de la vista ' . $path . 'No existe!!', E_USER_NOTICE);
			return false;
		}
		
		//finalmete incluimos a la plantilla
		require_once("./vendor/autoload.php");
		// la carpeta de las vistas
		
		$loader = new Twig_Loader_Filesystem($config->get('ViewsFolder'));
		
		$twig = new Twig_Environment($loader);
		echo $twig->render($name, $vars);
	}
}
?>