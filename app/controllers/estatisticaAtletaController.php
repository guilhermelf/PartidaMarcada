<?php
require (BLL.'/EstatisticaAtletaBLL.php');

class EstatisticaAtletaController extends Controller {
    
    function listar() {
        $bll = new EstatisticaAtletaBLL();
        
        echo $bll->getAll();
    }
}