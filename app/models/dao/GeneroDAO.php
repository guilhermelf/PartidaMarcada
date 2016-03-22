<?php
class GeneroDAO {

    function insert($genero) {
        DataBase::getFactory()->persist($genero);
        
        return DataBase::getFactory()->flush();
    }

    function update($genero) {
        DataBase::getFactory()->persist($genero);
        
        return DataBase::getFactory()->flush();
    }

    static function getById($id) {
        $genero = DataBase::getFactory()->getRepository('Genero')->find(array('id' => $id));

        return (empty($genero) ? false : $genero);
    }

    function getAll() {
        $generos = DataBase::getFactory()->getRepository('Genero')->findAll();

        return (empty($generos) ? false : $generos);
    }

    function delete($genero) {
        DataBase::getFactory()->remove($genero);
        
        return DataBase::getFactory()->flush();
    }
}