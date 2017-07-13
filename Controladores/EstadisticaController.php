<?php
require_once "Modelos/EstadisticaModel.php";
//JPGRAPH '/usr/share/php/jpgraph/src/jpgraph.php'
//require_once ( '/usr/share/php/jpgraph/src/jpgraph.php' );
//require_once ( '/usr/share/php/jpgraph/src/jpgraph_bar.php' );

require_once 'C:/xampp/htdocs/ContadorPag/jpgraph/src/jpgraph.php';
require_once 'C:/xampp/htdocs/ContadorPag/jpgraph/src/jpgraph_bar.php';
require_once "Negocio/FuncionesComunes.php";


class EstadisticaController extends ControllerBase
{
	private $estadistica = null;

	public function __construct(){
		parent::__construct();
		$this->estadistica = new EstadisticaModel();
	}
	public function listar()
	{
		$listado = $this->estadistica->listar("");
        $this->estadisticaImg();
        FuncionesComunes::contadorPagina(4);
		//$this->mostrar($listado, 'ImproductivaListView.twig');
        $this->mostrar($listado, 'EstadisticaView.twig');
      
	}
	

	# metodos privados
	private function mostrar($listado, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$this->show($vista, $data);
         
	}
 
    public function estadisticaImg(){
       
        try{

          



        $datay =array( 62 , 105 , 85 , 50 );
        /*while($row = mysql_fetch_array($res)){
        $datos []= $row['visitas'];
        $labels[]=$row['nombre'];
*/      $vis= array();
        $listado = $this->estadistica->listar("");
        foreach ($listado as $estado){
            $vis[]= $estado->visitas;
          //  $Vis[]
            
        }
        
        


        // Create the graph. These two calls are always required
        $graph = new Graph ( 350 , 220 , 'auto' );
        $graph -> SetScale ( "textlin" );

        //$theme_class="DefaultTheme";
        //$graph->SetTheme(new $theme_class());

        // set major and minor tick positions manually
        $graph -> yaxis -> SetTickPositions (array( 0 , 30 , 60 , 90 , 120 , 150 ), array( 15 , 45 , 75 , 105 , 135 ));
        $graph -> SetBox ( false );

        //$graph->ygrid->SetColor('gray');
        $graph -> ygrid -> SetFill ( false );
        $graph -> xaxis -> SetTickLabels (array( 'A' , 'B' , 'C' , 'D' ));
        $graph -> yaxis -> HideLine ( false );
        $graph -> yaxis -> HideTicks ( false , false );

        // Create the bar plots
        $b1plot = new BarPlot ( $vis );

        // ...and add it to the graPH
        $graph -> Add ( $b1plot );


        $b1plot -> SetColor ( "white" );
        $b1plot -> SetFillGradient ( "#4B0082" , "white" , GRAD_LEFT_REFLECTION );
        $b1plot -> SetWidth ( 45 );
        $graph -> title -> Set ( "Bar Gradient(Left reflection)" );

        // Display the graph
        //$graph -> Stroke ();

        //$graph->Stroke('img\estadistica.png');

        $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
 
        // Stroke image to a file and browser
 
        // Default is PNG so use ".png" as suffix
        $fileName = "img\imagefile.png";
        $graph->img->Stream($fileName);
 
// Send it back to browser
       // $graph->img->Headers();
        //$graph->img->Stream();
        }catch(Exception $e){
            $e->getMessage();
        }
        

    }


}

?>