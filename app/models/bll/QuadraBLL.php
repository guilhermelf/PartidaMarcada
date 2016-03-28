<?php
require_once(DAO.'/quadraDAO.php');

class QuadraBLL {
    function getAll() {
        $dao = new QuadraDAO();
        
        $quadras = $dao->getAll();
       
        $json = [];

        if(empty($quadras)) {
            echo "vazio!";
        } else {
            foreach ($quadras as $quadra) {                         
                $json[] = $quadra->toJson();
            }
            
            return json_encode($json);
        }
    }
}