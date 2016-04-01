<?php
require (BLL.'/quadraBLL.php');

class quadraController extends Controller {
    function listar() {
        $bll = new quadraBLL();
        
        echo $bll->getAll();
    }
}