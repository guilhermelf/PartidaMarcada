<?php

require (BLL . '/ParqueEsportivoBLL.php');

class ParqueEsportivoController extends Controller {

    function index_action() {
        $this->View('quadra/index');
    }

    function listar() {
        if (empty($_SESSION['usuario'])) {
            $bll = new parqueEsportivoBLL();

            echo $bll->getAll();
        } else {
            $this->AccessDenied();
        }
    }
}
