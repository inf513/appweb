<?php
class UsuarioModel extends ModelBase{

	private $pkUsuario;
	private $nickName;
	private $nombreCompleto;
	private $apellidos;
	private $email;
	private $password;
	private $fkGrupoUsuario;

	public function __construct()
	{
		parent::__construct();
		$this->tabla 	= "usuario";
		$this->sequencia = "usuario_pkusuario_seq";
		$pkUsuario 		= 0;
		$nickName 		= "";
		$nombreCompleto	= "";
		$apellidos		= "";
		$email			= "";
		$password		= "";
		$fkGrupoUsuario	= -1;
	}

	/**
	 * Metodo donde se implementa la condicion
	 * @return
	 */
	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkusuario"] = $this->pkUsuario;
			return $parametros;
	}
	/**
	 * Metodo que se implementa en el modelo
	 * @return 
	 */
	protected function getParametros(){
		
		$parametros = array();			
		
		$parametros[":nickname"] 		= $this->nickName;
		$parametros[":nombrecompleto"] 	= $this->nombreCompleto;
		$parametros[":apellidos"] 		= $this->apellidos;
		$parametros[":email"] 			= $this->email;
		$parametros[":password"] 		= $this->password;
		$parametros[":fkGrupoUsuario"] 	= $this->fkGrupoUsuario;

		return $parametros;
	}

	/**
	 * Metodo que devuelve el sql para el listado de los modelos
	 * @return String con la consulta
	 */
	protected function getSqlListar(){
		$consulta = "SELECT pkUsuario, nickName, nombreCompleto, apellidos, email, password, fkGrupoUsuario FROM " . $this->tabla;

		return $consulta;
	}
	protected function getIdTabla(){
		return $this->pkUsuario;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>