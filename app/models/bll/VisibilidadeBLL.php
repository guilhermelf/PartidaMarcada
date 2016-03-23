<?php
require_once(DAO.'/visibilidadeDAO.php');

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
}