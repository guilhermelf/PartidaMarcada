<?php

require_once(DAO . '/GeneroDAO.php');

class generoBLL {

    function getAll() {
        $dao = new GeneroDAO();

        $generos = $dao->getAll();

        $json = [];

        if (empty($generos)) {
            echo "vazio!";
        } else {
            foreach ($generos as $genero) {
                $json[] = $genero->toJson();
            }

            return json_encode($json);
        }
    }

    function getById($id) {
        $dao = new GeneroDAO();

        $genero = $dao->getById($id);

        return $genero;
    }
}
