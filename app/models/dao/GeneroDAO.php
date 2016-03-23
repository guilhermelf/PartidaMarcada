<?php
class GeneroDAO {
    function persist($genero) {
        try {
            DataBase::getFactory()->persist($genero);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($genero);
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $genero =  DataBase::getFactory()->getRepository('Genero')->find(array('id' => $id));

            return (empty($genero) ? false : $genero);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $generos = DataBase::getFactory()->getRepository('Genero')->findAll();

            return (empty($generos) ? false : $generos);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($genero) {
        try {
            DataBase::getFactory()->remove($genero);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($genero);
        } catch (Exception $ex) {
            return false;
        }   
    }
}