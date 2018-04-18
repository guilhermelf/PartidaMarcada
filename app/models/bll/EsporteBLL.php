<?php
require_once(DAO.'/EsporteDAO.php');

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
    
    function getById($id) {
        $dao = new EsporteDAO();
        
        $esporte = $dao->getById($id);
        
        return $esporte;
    }
}