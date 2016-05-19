<?php

require (BLL . '/UsuarioBLL.php');

class UsuarioController extends Controller {

    function index_action() {
        if (empty($_SESSION['tipo']) and $_SESSION['tipo'] != "usuario") {
            $this->AccessDenied();
        } else {
            $this->View('usuario/index');
        }
    }
    
    function amigos() {
        if (empty($_SESSION['tipo']) and $_SESSION['tipo'] != "usuario") {
            $this->AccessDenied();
        } else {
            $this->View('usuario/amigos');
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
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario')
            $this->AccessDenied();
        else
            $this->View('usuario/alterarsenha');
    }
    
    function atualizarPerfil() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario')
            $this->AccessDenied();
        else
            $this->View('usuario/atualizarperfil');
    }

    function alterarEmail() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario')
            $this->AccessDenied();
        else
            $this->View('usuario/alteraremail');
    }

    function atualizarEmail() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario')
            $this->AccessDenied();
        else {
            $bll = new UsuarioBLL();

            echo json_encode($bll->atualizarEmail($_POST));
        }
    }

    function atualizarSenha() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario')
            $this->AccessDenied();
        else {
            $bll = new UsuarioBLL();

            echo json_encode($bll->atualizarSenha($_POST));
        }
    }
    
    function atualizar() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario') {
            $this->AccessDenied();
            echo "merda";
        } else {
            $bll = new UsuarioBLL();
            
            echo json_encode($bll->update($_POST));         
        }
    }

    function perfil($id) {
        if (empty($_SESSION['tipo']))
            $this->AccessDenied();
        else {

            $bll = new UsuarioBLL();
            $usuario = $bll->getById($id);
            if(!empty($usuario))
                $this->View('usuario/perfil', $usuario);
            else
                $this->View('naoencontrada');
        }
    }
    
    function buscarUsuario() {
        $bll = new UsuarioBLL();
        
        $usuario = $bll->getById($_SESSION['id']);
        
        echo json_encode($usuario->toJson());
    }
}
