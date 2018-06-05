<?php
require_once(DAO . '/EstatisticaQuadraDAO.php');
require_once(DAO . '/PartidaDAO.php');
require_once(BLL . '/QuadraBLL.php');
require_once(BLL . '/UsuarioBLL.php');
require_once(BLL . '/PartidaBLL.php');

class EstatisticaQuadraBLL {

    function getAll() {
        $dao = new EstatisticaQuadraDAO();
        
        $estatisticaQuadras = $dao->getAll();
       
        $json = [];

        if(empty($estatisticaQuadras)) {
            echo "vazio!";
        } else {
            foreach ($estatisticaQuadras as $estatisticaQuadra) {                         
                $json[] = $estatisticaQuadra->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new EstatisticaQuadraDAO();
        
        $estatisticaQuadra = $dao->getById($id);
        
        return $estatisticaQuadra;
    }
    
    function insert($parqueEsportivo) {
        try {
            if (empty($parqueEsportivo)) {
                return 0;
            } else {
                $estatisticaQuadra = new EstatisticaQuadra();
                
                $estatisticaQuadra->setParqueEsportivo($parqueEsportivo);
                $estatisticaQuadra->setAvaliacoes(0);
                $estatisticaQuadra->setAtendimento(0);
                $estatisticaQuadra->setQualidade(0);
                $estatisticaQuadra->setEstrutura(0);
                $estatisticaQuadra->setPartidas(0);

                $dao = new EstatisticaQuadraDAO();

                if ($dao->persist($estatisticaQuadra)) {
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