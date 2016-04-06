<?php
class IndexController extends Controller {
    function index_action() {
        if(empty($_SESSION['tipo']))
            $this->View('index');
        else {
            if ($_SESSION['tipo'] == "usuario") {
                $this->View('usuario/index');
            }
        }
    }
}