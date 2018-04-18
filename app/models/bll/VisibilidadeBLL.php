<?php
require_once(DAO.'/VisibilidadeDAO.php');

class VisibilidadeBLL {
    function getAll() {
        $dao = new VisibilidadeDAO();
        
        $visibilidades = $dao->getAll();
       
        $json = [];

        if(empty($visibilidades)) {
            echo "vazio!";
        } else {
            foreach ($visibilidades as $visibilidade) {                         
                $json[] = $visibilidade->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new VisibilidadeDAO();
        
        $visibilidade = $dao->getById($id);
        
        return $visibilidade;
    }
}