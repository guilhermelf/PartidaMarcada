<?php
require_once(DAO.'/estadoDAO.php');

class EstadoBLL {
    function getAll() {
        $dao = new EstadoDAO();
        
        $estados = $dao->getAll();
       
        $json = [];

        if(empty($estados)) {
            echo "vazio!";
        } else {
            foreach ($estados as $estado) {                         
                $json[] = $estado->toJson();
            }
            
            return json_encode($json);
        }
    }
}