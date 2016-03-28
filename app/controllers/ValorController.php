<?php
require (BLL.'/ValorBLL.php');

class ValorController extends Controller {
    function listar() {
        $bll = new valorBLL();
        
        echo $bll->getAll();
    }
}