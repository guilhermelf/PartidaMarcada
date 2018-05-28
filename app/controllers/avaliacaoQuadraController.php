<?php
    require (BLL . '/AvaliacaoQuadraBLL.php');
    
class AvaliacaoQuadraController extends Controller {
    
    function listar() {
        $bll = new quadraBLL();

        echo $bll->getAll();
    }
    
    function getById($avaliacaoQuadraId) {
        $bll = new AvaliacaoQuadraBLL();

        $avaliacaoQuadra = $bll->getById($avaliacaoQuadraId);
    
        echo json_encode($avaliacaoQuadra->toJson());
    }
    
    function salvar() {
        $avaliacaoQuadra = new AvaliacaoQuadraBLL();

        echo json_encode($avaliacaoQuadra->insert($_POST));
    }
}