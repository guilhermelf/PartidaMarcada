<?php
require (BLL.'/cidadeBLL.php');

class CidadeController extends Controller {
    
    function listar() {
        $bll = new cidadeBLL();
        
        echo $bll->getAll();
    }
    
    
}