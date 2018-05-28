<?php
require_once(DAO . '/AvaliacaoQuadraDAO.php');
require_once(DAO . '/PartidaDAO.php');
require_once(BLL . '/QuadraBLL.php');
require_once(BLL . '/UsuarioBLL.php');
require_once(BLL . '/PartidaBLL.php');

class AvaliacaoQuadraBLL {

    function getAll() {
        $dao = new AvaliacaoQuadraDAO();
        
        $avaliacaoQuadras = $dao->getAll();
       
        $json = [];

        if(empty($avaliacaoQuadras)) {
            echo "vazio!";
        } else {
            foreach ($avaliacaoQuadras as $avaliacaoQuadra) {                         
                $json[] = $avaliacaoQuadra->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new AvaliacaoQuadraDAO();
        
        $avaliacaoQuadra = $dao->getById($id);
        
        return $avaliacaoQuadra;
    }
    
    function insert($dados) {
        try {
            if (empty($dados)) {
                return 0;
            } else {
                $quadraBLL = new QuadraBLL();
                $usuarioBLL = new UsuarioBLL();
                $partidaBLL = new PartidaBLL();
                
                $quadra = $quadraBLL->getById($dados['quadra']);
                $usuario = $usuarioBLL->getById($dados['usuario']);
                $partida = $partidaBLL->getById($dados['partida']);
                
                $avaliacaoQuadra = new AvaliacaoQuadra();
                
                $avaliacaoQuadra->setQuadra($quadra);
                $avaliacaoQuadra->setUsuario($usuario);
                $avaliacaoQuadra->setPartida($partida);
                $avaliacaoQuadra->setEstrutura($dados['estrutura']);
                $avaliacaoQuadra->setQualidade($dados['qualidade']);
                $avaliacaoQuadra->setAtendimento($dados['atendimento']);

                $dao = new AvaliacaoQuadraDAO();

                if ($dao->persist($avaliacaoQuadra)) {
                    Retorno::setStatus(1);
                    Retorno::setMensagem("Avaliação cadastrada com sucesso!");

                    return Retorno::toJson();
                } else {
                    Retorno::setStatus(0);
                    Retorno::setMensagem("Erro ao cadastrar avaliação!");

                    return Retorno::toJson();
                }
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}