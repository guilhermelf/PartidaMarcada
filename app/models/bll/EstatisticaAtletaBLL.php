<?php
require_once(DAO . '/EstatisticaAtletaDAO.php');
require_once(DAO . '/PartidaDAO.php');
require_once(BLL . '/QuadraBLL.php');
require_once(BLL . '/UsuarioBLL.php');
require_once(BLL . '/PartidaBLL.php');

class EstatisticaAtletaBLL {

    function getAll() {
        $dao = new EstatisticaAtletaDAO();
        
        $estatisticaAtletas = $dao->getAll();
       
        $json = [];

        if(empty($estatisticaAtletas)) {
            echo "vazio!";
        } else {
            foreach ($estatisticaAtletas as $estatisticaAtleta) {                         
                $json[] = $estatisticaAtleta->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new EstatisticaAtletaDAO();
        
        $estatisticaAtleta = $dao->getById($id);
        
        return $estatisticaAtleta;
    }
    
    function insert($usuario) {
        try {
            if (empty($usuario)) {
                return 0;
            } else {
                $estatisticaAtleta = new EstatisticaAtleta();
                
                $estatisticaAtleta->setUsuario($usuario);
                $estatisticaAtleta->setAvaliacoes(0);
                $estatisticaAtleta->setComportamento(0);
                $estatisticaAtleta->setHabilidade(0);
                $estatisticaAtleta->setOrganizador(0);
                $estatisticaAtleta->setParticipacoes(0);
                $estatisticaAtleta->setPartidasMarcadas(0);
                $estatisticaAtleta->setPontos(100);
                $estatisticaAtleta->setPontualidade(0);
                $estatisticaAtleta->setOrganizadasOnline(0);

                $dao = new EstatisticaAtletaDAO();

                if ($dao->persist($estatisticaAtleta)) {
                    return 1;
                } else {
                    return 0;
                }
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}