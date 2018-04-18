<?php
require_once(DAO.'/EstadoDAO.php');

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
    
    function getById($id) {
        $dao = new EstadoDAO();
        
        $estado = $dao->getById($id);
        
        return $estado;
    }
}