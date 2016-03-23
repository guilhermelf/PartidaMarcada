<?php
require_once(DAO.'/ParqueEsportivoDAO.php');

class ParqueEsportivoBLL {
    function getAll() {
        $dao = new ParqueEsportivoDAO();
        
        $parquesEsportivos = $dao->getAll();
       
        $json = [];

        if(empty($parquesEsportivos)) {
            echo "vazio!";
        } else {
            foreach ($parquesEsportivos as $parqueEsportivo) {                         
                $json[] = $parqueEsportivo->toJson();
            }
            
            return json_encode($json);
        }
    }
}