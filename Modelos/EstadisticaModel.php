<?php

    class EstadisticaModel extends ModelBase{
        
        public $id;
        public $paginas;
        public $visitas;

    public function __construct()
	{
	
        parent::__construct();
		$this->tabla = 'contador';
        $id=0;
        $paginas='';
        $visitas='';
	
    }

    protected function getIdTabla(){
		return $this->id;
	}

    protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":id"] = $this->id;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
	
		$parametros[":visitas"] = $this->visitas;
		$parametros[":paginas"] = $this->paginas;


		return $parametros;
	}

    protected function getSqlListar(){
		return " SELECT id, paginas, visitas FROM " . $this->tabla;
	}

    protected function insertSqlEquipoP(){
            $insert = "UPDATE contador SET visitas =visitas +1 WHERE ID = '1'";
            $update = $connect->query($insert);
        
    }

    	protected function modificarDatos($filas){
		return $filas;
	}

    
   
}


?>