<?php
    require (BLL . '/AvaliacaoOrganizadorBLL.php');
    
class AvaliacaoOrganizadorController extends Controller {
    
    function listar() {
        $bll = new AvaliacaoOrganizadorBLL();

        echo $bll->getAll();
    }
    
    function getById($avaliacaoOrganizadorId) {
        $bll = new AvaliacaoOrganizadorBLL();

        $avaliacaoOrganizador = $bll->getById($avaliacaoOrganizadorId);
    
        echo json_encode($avaliacaoOrganizador->toJson());
    }
    
    function salvar() {
        $avaliacaoOrganizador = new AvaliacaoOrganizadorBLL();

        echo json_encode($avaliacaoOrganizador->insert($_POST));
    }
}