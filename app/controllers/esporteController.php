<?php
require (BLL.'/EsporteBLL.php');

class esporteController extends Controller {
    function listar() {
        $bll = new esporteBLL();
        
        echo $bll->getAll();
    }
} 