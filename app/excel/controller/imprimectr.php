<?php
namespace app\excel\controller;

/**
 *
 */
class imprimectr extends \app\core\controller\controller
{

  function __construct()
  {
    // Il appel un model de notre framework
    parent::__construct("");
    # code...
  }

  /**
  * Une requete venant de la vue
  */
  public function imprimer_action($data){
    $table_imprimer="";
    if(isset($_SESSION["doc_imprimer_excel"]))
    if($_SESSION["doc_imprimer_excel"]!="")$table_imprimer=$_SESSION["doc_imprimer_excel"];

    if($table_imprimer!=""){
    $htmlPhpExcel = new \Ticketpark\HtmlPhpExcel\HtmlPhpExcel($table_imprimer);

    // Create and output the excel file to the browser

    //$htmlPhpExcel->process()->output();
    $nom_fichier="vendor/doc_excel/my_excel_file".rand().'.xls';
    // Alternatively create the excel and save to a file
    $htmlPhpExcel->process()->save($nom_fichier);

    // or get the PHPExcel object to do further work with it
    $phpExcelObject = $htmlPhpExcel->process()->getExcelObject();
  }
    # code...
  }

}

 ?>
