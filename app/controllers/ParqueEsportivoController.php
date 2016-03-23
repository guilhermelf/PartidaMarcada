<?php
require (BLL.'/ParqueEsportivoBLL.php');

class ParqueEsportivoController extends Controller {
    function listar() {
        if(empty($_SESSION['usuario'])) {
            $bll = new parqueEsportivoBLL();
        
            echo $bll->getAll();
        } else {
            $this->AccessDenied();
        }
    }
}