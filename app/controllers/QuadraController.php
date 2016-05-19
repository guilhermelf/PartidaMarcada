<?php

require (BLL . '/quadraBLL.php');

class quadraController extends Controller {

    function listar() {
        $bll = new quadraBLL();

        echo $bll->getAll();
    }

    function salvar() {
        try {
            if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'quadra')
                $this->AccessDenied();
            else {
                $bll = new QuadraBLL();

                echo json_encode($bll->insert($_POST));
            }
        } catch (Exception $ex) {
            $this->AccessDenied();
        }
    }

    function buscarQuadra($id) {
        try {
            if (empty($_SESSION['tipo']))
                $this->AccessDenied();
            else {
                $bll = new QuadraBLL();

                $quadra = $bll->getById($id);

                echo json_encode($quadra->toJson());
            }
        } catch (Exception $ex) {
            $this->AccessDenied();
        }
    }
    
    function atualizar() {
        if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'quadra') {
            $this->AccessDenied();
        } else {
            $bll = new QuadraBLL();
            
            echo json_encode($bll->update($_POST));         
        }
    }
    
    function listarPorParqueEsportivo() {
        $parqueEsportivo = $_POST["parqueEsportivo"];
        
        $bll = new QuadraBLL();
        
        echo $bll->getByParqueEsportivo($parqueEsportivo);
    }
}
