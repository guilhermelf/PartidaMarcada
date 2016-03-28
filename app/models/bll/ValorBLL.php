<?php
require_once(DAO.'/valorDAO.php');

class valorBLL {
    function getAll() {
        $dao = new ValorDAO();
        
        $valores = $dao->getAll();
       
        $json = [];

        if(empty($valores)) {
            echo "vazio!";
        } else {
            foreach ($valores as $valor) {                         
                $json[] = $valor->toJson();
            }
            
            return json_encode($json);
        }
    }
}