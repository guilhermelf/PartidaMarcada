<?php
require (BLL.'/cidadeBLL.php');

class CidadeController extends Controller {
    
    function getAll() {
        $bll = new cidadeBLL();
        
        echo $bll->getAll();
    }
}