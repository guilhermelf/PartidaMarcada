<?php

require (BLL . '/PartidaBLL.php');

class PartidaController extends Controller {

    function listar() {
        $bll = new PartidaBLL();

        echo $bll->getAll();
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

        $quadra = $bll->getById($partidaId);
    
        echo json_encode($quadra->toJson());
    }
}
