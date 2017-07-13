<?php
require_once "Modelos/EstadisticaModel.php";
require_once "Negocio/FuncionesComunes.php";

require_once 'frameworks/jpgraph/src/jpgraph.php';
require_once 'frameworks/jpgraph/src/jpgraph_bar.php';




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
        //$this->estadisticaImg1();
        $this->estadisticaImg();
        $dummy = rand();
        $fileName = "img\imagefile.png?dummy=" . $dummy;
        FuncionesComunes::contadorPagina(4);
        $this->mostrar($fileName, 'EstadisticaView.twig');
	}
	

	# metodos privados
	private function mostrar($fileName, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['fileName'] = $fileName;
		$this->show($vista, $data);
         
	}
    /**
     * metodo que no se esta usando por que tiene problemas
     *
     * @return void
     */
    public function estadisticaImge(){       
        try{
            // $datay =array( 62 , 105 , 85 , 50 );
            /*while($row = mysql_fetch_array($res)){
            $datos []= $row['visitas'];
            $labels[]=$row['nombre'];
            */      
            $vis= array();
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
            $graph -> xaxis -> SetTickLabels (array('5','3','4','1','2','6','7','9','8'  ));
            $graph -> yaxis -> HideLine ( false );
            $graph -> yaxis -> HideTicks ( false , false );

            // Create the bar plots
            $b1plot = new BarPlot ( $vis );

            // ...and add it to the graPH
            $graph -> Add ( $b1plot );

            $b1plot -> SetColor ( "white" );
            $b1plot -> SetFillGradient ( "#4B0082" , "white" , GRAD_LEFT_REFLECTION );
            $b1plot -> SetWidth ( 45 );
            $graph -> title -> Set ( "Estadistica de visitas" );

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
 
    public function estadisticaImg(){
        try{
        $pag= array();
        $vis= array();
        $listado = $this->estadistica->listar("");
        foreach ($listado as $estado){
            $vis[]= $estado->visitas;
            $pag[]= $estado->id;
        }
        
                
        $datay=array(62,105,85,50);


        // Create the graph. These two calls are always required
        $graph = new Graph(500,400,'auto');
        $graph->SetScale("textlin");
        $graph->title->set("CONTADOR DE PAGINAS");
        $graph->xaxis->title->set("Paginas");
        $graph->xaxis->SetTickLabels($pag);
        $graph->yaxis->title->set("Visitas");

        $barplot1= new BarPlot($vis);
        //$barplot1->SetColor("white");
        $barplot1->SetFillGradient("#4B0082","#e3cef6",GRAD_HOR);
        $barplot1->SetWidth(30);


        $graph->Add($barplot1);


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
    public function estadisticaImg1(){
        try{
            $pag= array();
            $vis= array();
            $listado = $this->estadistica->listar("");
            foreach ($listado as $estado){
                $vis[]= $estado->visitas;
                $pag[]= $estado->paginas;
            }

        // Create the graph. These two calls are always required
        $graph = new Graph(600,500,'auto');
        $graph->img->SetMargin(60,20,35,75);
        $graph->SetScale("textlin");
        $graph->SetMarginColor("lightblue:1.1");
        $graph->SetShadow();

        //configuracion del titulo        
        $graph->title->set("CONTADOR DE PAGINAS");
        $graph->title->SetMargin(8);
        $graph->title->SetFont(FF_VERDANA,FS_BOLD,12);
        $graph->title->SetColor("darkred");        

        // configuracion de fuente para axis
        $graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
        $graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,10);

        // Show 0 label on Y-axis (default is not to show)
        $graph->yscale->ticks->SupressZeroLabel(false);
        $graph->yaxis->title->set("Visitas");

        // Setup X-axis labels
        $graph->xaxis->SetTickLabels($pag);        
        $graph->xaxis->SetLabelAngle(80);
        $graph->xaxis->title->set("pag");
        
        $barplot1= new BarPlot($vis);
        //$barplot1->SetColor("white");
        $barplot1->SetFillGradient("#4B0082","#e3cef6",GRAD_HOR);
        $barplot1->SetWidth(30);


        $graph->Add($barplot1);


        $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
        
        // Stroke image to a file and browser
 
        // Default is PNG so use ".png" as suffix
        $fileName = "img\imagefile.png";
        $graph->img->Stream($fileName);

        }catch(Exception $e){
            $e->getMessage();
        }
    }    
}

?>