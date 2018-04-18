<?php
require (BLL.'/estadoBLL.php');

class EstadoController extends Controller {
    function listar() {
        $bll = new estadoBLL();
        
        echo $bll->getAll();
    }
}