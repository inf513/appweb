<?php
class UsuarioModel extends ModelBase{

	public $pkUsuario;
	public $nickName;
	public $nombreCompleto;
	public $apellidos;
	public $email;
	public $password;
	public $fkGrupoUsuario;

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
		$consulta = "  SELECT u.pkUsuario, u.nickName, u.nombreCompleto, u.apellidos, ";
		$consulta .= " u.email, u.password, g.descripcion as grupo, u.fkgrupousuario ";
		$consulta .= " FROM usuario u ";
		$consulta .= " INNER JOIN grupo g on u.fkgrupousuario = g.pkgrupo ";

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