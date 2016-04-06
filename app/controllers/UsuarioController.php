<?php

require (BLL . '/UsuarioBLL.php');

class UsuarioController extends Controller {

    function index_action() {
        if (empty($_SESSION['tipo']) || $_SESSION['tipo'] != "usuario") {
            $this->AccessDenied();
        } else {
            $this->View('usuario/index');
        }
    }

    function cadastrar() {
        $this->view('./usuario/cadastrar');
    }

    function logar() {
        if (empty($_POST)) {
            echo "erro";
        } else {
            $email = $_POST['usuario-email'];
            $senha = $_POST['usuario-senha'];

            $usuario = new UsuarioBLL();

            $user = $usuario->logar($email, $senha);

            print_r($_SESSION['nome']);
        }
    }

    function deslogar() {
        $usuario = new UsuarioBLL();

        $usuario->deslogar();

        echo 'erro';
    }

    function salvar() {
        $usuario = new UsuarioBLL();

        echo $usuario->insert($_POST);    
    }

}
