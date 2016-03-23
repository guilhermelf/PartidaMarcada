<?php
require_once(DAO.'/cidadeDAO.php');

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
}