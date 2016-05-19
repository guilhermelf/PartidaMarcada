<?php
require_once(DAO.'/pisoDAO.php');

class pisoBLL {
    function getAll() {
        $dao = new PisoDAO();
        
        $pisos = $dao->getAll();
       
        $json = [];

        if(empty($pisos)) {
            echo "vazio!";
        } else {
            foreach ($pisos as $piso) {                         
                $json[] = $piso->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new PisoDAO();
        
        $piso = $dao->getById($id);
        
        return $piso;
    }
}