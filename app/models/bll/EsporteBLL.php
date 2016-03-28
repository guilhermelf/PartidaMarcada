<?php
require_once(DAO.'/esporteDAO.php');

class esporteBLL {
    function getAll() {
        $dao = new EsporteDAO();
        
        $esportes = $dao->getAll();
       
        $json = [];

        if(empty($esportes)) {
            echo "vazio!";
        } else {
            foreach ($esportes as $esporte) {                         
                $json[] = $esporte->toJson();
            }
            
            return json_encode($json);
        }
    }
}