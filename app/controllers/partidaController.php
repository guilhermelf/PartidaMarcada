<?php
require (BLL . '/PartidaBLL.php');

class PartidaController extends Controller {

    function partida($id) {
        if (empty($_SESSION['tipo']))
            $this->AccessDenied();
        else {              
            $bll = new PartidaBLL();
            
            if($bll->permitirAcesso($id)) {
                $partida = $bll->getById($id);
                if (!empty($partida))
                    $this->View('partida/partida', $partida);
                else
                    $this->View('naoencontrada');
            } else {
                $this->AccessDenied();
            }                    
        }
    }
    
    function listar() {
        $bll = new PartidaBLL();

        echo $bll->getAll();
    }
    
    function listarMinhasNovasPartidas() {
        $bll = new PartidaBLL();
        
        $partidas = $bll->getNew();
    
        echo json_encode($partidas);
    }
    
    function listarMinhasAntigasPartidas() {
        $bll = new PartidaBLL();

        echo $bll->getPast();
    }

    function salvar() {
        if (empty($_SESSION))
            $this->AccessDenied();
        else {
            $partida = new PartidaBLL();

            echo json_encode($partida->insert($_POST));
        }
    }
    
    function gerenciar() {
        if (empty($_SESSION))
            $this->AccessDenied();
        else {
            $this->view('./partida/index');
        }      
    }
    
    function getByUsuario() {
        $bll = new PartidaBLL();

        echo $bll->getByUsuario();
    }
    
    function getById($partidaId) {
        $bll = new PartidaBLL();

        $partida = $bll->getById($partidaId);
    
        echo json_encode($partida->toJson());
    }
    
    function cancelarPartida($partidaId) {
        $bll = new PartidaBLL();
    
        echo json_encode($bll->cancel($partidaId));
    }
    
    function partidaOcorreu($id) {
        $bll = new PartidaBLL();

        echo $bll->partidaOcorreu($id);
    }
    
    function pesquisar() {
        if (empty($_SESSION['tipo']))
            $this->AccessDenied();
        else {
            $bll = new PartidaBLL();

            echo $bll->pesquisar($_POST);
        }
    }
    
    function buscarPartidasParqueEsportivo() {
        $bll = new PartidaBLL();

        echo $bll->buscarPartidasParqueEsportivo();
    }
}
