<?php
require_once(DAO.'/cidadeDAO.php');
require_once(BLL.'/estadoBLL.php');

class CidadeBLL {
    function getAll() {
        $dao = new CidadeDAO();
        
        $cidades = $dao->getAll();
       
        $json = [];

        if(empty($cidades)) {
            echo "vazio!";
        } else {
            foreach ($cidades as $cidade) {                         
                $json[] = $cidade->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new CidadeDAO();
        
        $cidade = $dao->getById($id);
        
        return $cidade;
    }
    
    function getByEstado($idEstado) {
        $dao = new CidadeDAO();
        
        $cidades = $dao->getByEstado($idEstado);
       
        $json = [];

        if(empty($cidades)) {
            echo "vazio!";
        } else {
            foreach ($cidades as $cidade) {                         
                $json[] = $cidade->toJson();
            }
            
            return json_encode($json);
        }
    }
}