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
    
    function cadastrar() {
        $this->view('./quadra/cadastrar');
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
        $this->view('./quadra/logar');
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
}
