<?php
class UsuarioController extends Controller {
    function index_action() {
        $this->View('index');
    }
    
    function cadastrar() {
        $this->listar('./usuario/cadastrar');
    }
}
