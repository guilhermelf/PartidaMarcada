<?php
require (BLL.'/VisibilidadeBLL.php');

class VisibilidadeController extends Controller {
       
    function listar() {
        $bll = new visibilidadeBLL();
        
        echo $bll->getAll();
    }
} 