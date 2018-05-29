<?php
require_once(DAO . '/AvaliacaoOrganizadorDAO.php');
require_once(DAO . '/PartidaDAO.php');
require_once(BLL . '/QuadraBLL.php');
require_once(BLL . '/UsuarioBLL.php');
require_once(BLL . '/PartidaBLL.php');

class AvaliacaoOrganizadorBLL {

    function getAll() {
        $dao = new AvaliacaoOrganizadorDAO();
        
        $avaliacaoOrganizadors = $dao->getAll();
       
        $json = [];

        if(empty($avaliacaoOrganizadors)) {
            echo "vazio!";
        } else {
            foreach ($avaliacaoOrganizadors as $avaliacaoOrganizador) {                         
                $json[] = $avaliacaoOrganizador->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new AvaliacaoOrganizadorDAO();
        
        $avaliacaoOrganizador = $dao->getById($id);
        
        return $avaliacaoOrganizador;
    }
    
    function insert($dados) {
        try {
            if (empty($dados)) {
                return 0;
            } else {
                $parqueEsportivoBLL = new ParqueEsportivoBLL();
                $usuarioBLL = new UsuarioBLL();
                $partidaBLL = new PartidaBLL();
                
                $parqueEsportivo = $parqueEsportivoBLL->getById($_SESSION['id']);
                $usuario = $usuarioBLL->getById($dados['usuario']);
                $partida = $partidaBLL->getById($dados['partida']);
                
                $avaliacaoOrganizador = new AvaliacaoOrganizador();
                
                $avaliacaoOrganizador->setParqueEsportivo($parqueEsportivo);
                $avaliacaoOrganizador->setUsuario($usuario);
                $avaliacaoOrganizador->setPartida($partida);
                $avaliacaoOrganizador->setQualidade($dados['avaliacao']);

                $dao = new AvaliacaoOrganizadorDAO();

                if ($dao->persist($avaliacaoOrganizador)) {
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
    
    function avaliacaoOrganizadorExiste($parqueEsportivo, $partida) {
        $dao = new AvaliacaoOrganizadorDAO();        
        
        return $dao->avaliacaoOrganizadorExiste($parqueEsportivo, $partida);
    }
}