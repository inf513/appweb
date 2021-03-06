<?php
require_once "Modelos/UsuarioModel.php";
require_once "Modelos/GrupoModel.php";
require_once "Negocio/FuncionesComunes.php";
/**
 * Clase controladora encargada de las acciones de usuario
 */

class UsuarioController extends ControllerBase
{
	private $usuario = null;
    private $grupo = null;
	private $contarSw = true;

	public function __construct(){
		parent::__construct();
		$this->contarSw = true;

		$this->grupo = new GrupoModel();
        $this->usuario = new UsuarioModel();
	}
	public function listar()
	{
		try {
			$listado = $this->usuario->listar("");
			if($this->contarSw){
				FuncionesComunes::contadorPagina(9);
			}
			$this->mostrar($listado, null, 'UsuarioListView.twig');
		} catch (Exception $e) {
			echo "[UsuarioController.listar] " . $e->getMessage();
		}
	}

	public function editar(){
		$this->contarSw = false;
		$this->usuario->pkUsuario = $_POST['pkUsuario'];

		$usr = $this->usuario->findOne("pkUsuario",$this->usuario->pkUsuario);
		
		#ademas enviamos la lista de grupos
		$grupos = $this->grupo->listar("");
		$this->mostrar($usr, $grupos, 'UsuarioView.twig');
	}

	public function nuevo(){
		$listar = null;
		$this->contarSw = false;
		#ademas enviamos la lista de grupos
		$grupos = $this->grupo->listar("");

		$this->mostrar($listar, $grupos, 'UsuarioView.twig');
	}

	public function guardar()
	{
		$this->contarSw = false;
		$this->usuario->pkUsuario 	    = $_POST['pkUsuario'];
		$this->usuario->nickName 	    = $_POST['nickName'];
		$this->usuario->nombreCompleto 	= $_POST['nombreCompleto'];
		$this->usuario->apellidos 		= $_POST['apellidos'];
		$this->usuario->email		    = $_POST['email'];
		$this->usuario->password 		= sha1($_POST['password']);
		$this->usuario->fkGrupoUsuario 	= $_POST['fkGrupoUsuario'];
	
		$this->usuario->guardarModel();

		$this->listar();
	}
	public function eliminar()
	{
		$this->contarSw = false;
		$this->usuario->pkUsuario = $_POST['pkUsuario'];
		$this->usuario->delModel();

		$this->listar();
	}

	# metodos privados
	private function mostrar($listado, $grupos, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$data['grupos'] = $grupos;

		$this->show($vista, $data);
	}
}
?>