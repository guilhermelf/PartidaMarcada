<?php
require (BLL.'/generoBLL.php');

class generoController extends Controller {
    function listar() {
        $bll = new generoBLL();
        
        echo $bll->getAll();
    }
} 