<?php
require (BLL.'/visibilidadeBLL.php');

class VisibilidadeController extends Controller {
       
    function listar() {
        $bll = new visibilidadeBLL();
        
        echo $bll->getAll();
    }
} 