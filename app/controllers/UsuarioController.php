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

            echo json_encode($usuario->logar($email, $senha));
        }
    }

    function deslogar() {
        $usuario = new UsuarioBLL();
        $usuario->deslogar();
    }

    function salvar() {
        $usuario = new UsuarioBLL();

        echo json_encode($usuario->insert($_POST));    
    }
    
    function alterarSenha() {
        if(empty($_SESSION['tipo'] or $_SESSION['tipo'] != 'usuario'))
            $this->AccessDenied ();
        else
            $this->View('usuario/alterarsenha');
    }
    
    function alterarEmail() {
        if(empty($_SESSION['tipo'] or $_SESSION['tipo'] != 'usuario'))
            $this->AccessDenied ();
        else
            $this->View('usuario/alteraremail');
    }
    
    function atualizarEmail() {
        if(empty($_SESSION['tipo'] or $_SESSION['tipo'] != 'usuario'))
            $this->AccessDenied();
        else {
            $bll = new UsuarioBLL();
                       
            echo json_encode($bll->atualizarEmail($_POST));
        }
    }
    
    function atualizarSenha() {
        if(empty($_SESSION['tipo'] or $_SESSION['tipo'] != 'usuario'))
            $this->AccessDenied();
        else {
            $bll = new UsuarioBLL();
                       
            echo json_encode($bll->atualizarSenha($_POST));
        }
    }
}
