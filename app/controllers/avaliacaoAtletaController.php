<?php
    require (BLL . '/AvaliacaoAtletaBLL.php');
    
class AvaliacaoAtletaController extends Controller {
    
    function listar() {
        $bll = new quadraBLL();

        echo $bll->getAll();
    }
    
    function getById($avaliacaoAtletaId) {
        $bll = new AvaliacaoAtletaBLL();

        $avaliacaoAtleta = $bll->getById($avaliacaoAtletaId);
    
        echo json_encode($avaliacaoAtleta->toJson());
    }
    
    function salvar() {
        $avaliacaoAtleta = new AvaliacaoAtletaBLL();

        echo json_encode($avaliacaoAtleta->insert($_POST));
    }
}