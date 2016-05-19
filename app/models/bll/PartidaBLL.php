<?php
require_once(DAO.'/partidaDAO.php');

class partidaBLL {
    function getAll() {
        $dao = new PartidaDAO();
        
        $partidas = $dao->getAll();
       
        $json = [];

        if(empty($partidas)) {
            echo "vazio!";
        } else {
            foreach ($partidas as $partida) {                         
                $json[] = $partida->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new PartidaDAO();
        
        $partida = $dao->getById($id);
        
        return $partida;
    }   
}