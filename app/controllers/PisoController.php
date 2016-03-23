<?php
require (BLL.'/PisoBLL.php');

class PisoController extends Controller {
    function listar() {
        $bll = new pisoBLL();
        
        echo $bll->getAll();
    }
}