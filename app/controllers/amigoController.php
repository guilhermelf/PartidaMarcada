<?php

require (BLL . '/AmigoBLL.php');

class AmigoController extends Controller {

    function salvar() {
        $bll = new AmigoBLL();

        echo json_encode($bll->insert($_POST));
    }

    function amizadeExistente() {
        $bll = new AmigoBLL();

        echo $bll->amizadeExiste($_POST);
    }

    function buscarAmigos() {
        if (empty($_SESSION['tipo']) and $_SESSION['tipo'] != "usuario") {
            $this->AccessDenied();
        } else {
            $bll = new AmigoBLL();

            echo $bll->buscarAmigos();
        }
    }
    
    function buscarAmigosConvidar() {
        if (empty($_SESSION['tipo']) and $_SESSION['tipo'] != "usuario") {
            $this->AccessDenied();
        } else {
            $bll = new AmigoBLL();

            echo $bll->buscarUsuarioConvidar($_POST);
        }
    }

    function amizadesPendentes() {
        $bll = new AmigoBLL();

        echo $bll->amizadesPendentes();
    }

    function aceitarAmizade() {
        $bll = new AmigoBLL();

        echo json_encode($bll->aceitarAmizade($_POST));
    }

    function rejeitarAmizade() {
        $bll = new AmigoBLL();

        echo json_encode($bll->excluirAmizade($_POST));
    }
    
    function desfazerAmizade() {
        $bll = new AmigoBLL();

        echo json_encode($bll->desfazerAmizade($_POST));
    }
}
