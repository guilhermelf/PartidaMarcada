<?php
require (BLL.'/EstatisticaQuadraBLL.php');

class EstatisticaQuadraController extends Controller {
    
    function listar() {
        $bll = new EstatisticaQuadraBLL();
        
        echo $bll->getAll();
    }
}