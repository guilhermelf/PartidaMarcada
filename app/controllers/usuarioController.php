<?php
class usuarioController extends Controller {
    function index_action() {
        $this->View('index');
    }
    
    function cadastrar() {
        $this->View('./usuario/cadastrar');
    }
}
