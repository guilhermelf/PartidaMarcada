<?php

require (BLL . '/ParqueEsportivoBLL.php');

class ParqueEsportivoController extends Controller {

    function index_action() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != "quadra") {
            $this->AccessDenied();
        } else {
            $bll = new ParqueEsportivoBLL();
            $parqueEsportivo = $bll->getById($_SESSION['id']);
            
            if($parqueEsportivo->getServicos()) {
                $this->View('quadra/index');
            } else {
                $this->View('quadra/quadras');
            }
        }     
    }

    function listar() {
        if (empty($_SESSION['usuario'])) {
            $bll = new parqueEsportivoBLL();

            echo $bll->getAll();
        } else {
            $this->AccessDenied();
        }
    }

    function cadastrar() {
        $this->view('quadra/cadastrar');
    }

    function salvar() {
        $bll = new ParqueEsportivoBLL();

        echo json_encode($bll->insert($_POST));
    }

    function deslogar() {
        $parqueEsportivoBLL = new ParqueEsportivoBLL();
        $parqueEsportivoBLL->deslogar();
    }

    function entrar() {
        $this->view('quadra/logar');
    }

    function logar() {
        if (empty($_POST)) {
            echo "erro";
        } else {
            $email = $_POST['quadra-email'];
            $senha = $_POST['quadra-senha'];

            $parqueEsportivo = new ParqueEsportivoBLL();

            echo json_encode($parqueEsportivo->logar($email, $senha));
        }
    }

    function alterarEmail() {
        try {
            if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'quadra')
            $this->AccessDenied();
        else
            $this->View('quadra/alteraremail');
        } catch (Exception $ex) {
            $this->AccessDenied();
        }
        
    }

    function atualizarEmail() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'quadra')
            $this->AccessDenied();
        else {
            $bll = new ParqueEsportivoBLL();

            echo json_encode($bll->atualizarEmail($_POST));
        }
    }

    function alterarSenha() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'quadra')
            $this->AccessDenied();
        else
            $this->View('quadra/alterarsenha');
    }

    function atualizarSenha() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'quadra')
            $this->AccessDenied();
        else {
            $bll = new ParqueEsportivoBLL();
            
            echo json_encode($bll->atualizarSenha($_POST));
        }
    }
    
    function perfil($id) {
        if (empty($_SESSION['tipo']))
            $this->AccessDenied();
        else {

            $bll = new ParqueEsportivoBLL();
            $parqueEsportivo = $bll->getById($id);
            if(!empty($parqueEsportivo))
                $this->View('quadra/perfil', $parqueEsportivo);
            else
                $this->View('naoencontrada');
        }
    }
    
    function atualizar() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'quadra') {
            $this->AccessDenied();
        } else {
            $bll = new ParqueEsportivoBLL();
            
            echo json_encode($bll->update($_POST));         
        }
    }
    
    function atualizarPerfil() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'quadra')
            $this->AccessDenied();
        else
            $this->View('quadra/atualizarperfil');
    }
    
    function buscarParqueEsportivo() {
        $bll = new ParqueEsportivoBLL();
        
        $parqueEsportivo = $bll->getById($_SESSION['id']);
        
        echo json_encode($parqueEsportivo->toJson());
    }
    
    function quadras () {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'quadra')
            $this->AccessDenied();
        else
            $this->View('quadra/quadras');
    }
    
    function pesquisar() {
        if (empty($_SESSION['tipo']))
            $this->AccessDenied();
        else {
            $bll = new ParqueEsportivoBLL();

            echo $bll->pesquisar($_POST);
        }
    }
    
    function isOnline() {
        $bll = new ParqueEsportivoBLL();
        echo $bll->isOnline();
    }
    
    function horarios($quadra = null) {
        $this->view('quadra/horarios', $quadra);
    }
}