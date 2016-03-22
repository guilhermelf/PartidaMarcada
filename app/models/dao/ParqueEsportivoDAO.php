<?php
class ParqueEsportivoDAO {

    function insert($parqueEsportivo) {
        try {
            DataBase::getFactory()->persist($parqueEsportivo);      
            DataBase::getFactory()->flush();
        
            return ($parqueEsportivo->getId() ? 1: 0);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }       
    }

    function update($parqueEsportivo) {
        DataBase::getFactory()->persist($parqueEsportivo);
        
        return DataBase::getFactory()->flush();
    }

    static function getById($id) {
        $parqueEsportivo = DataBase::getFactory()->getRepository('ParqueEsportivo')->find(array('id' => $id));

        return (empty($parqueEsportivo) ? false : $parqueEsportivo);
    }

    function getAll() {
        $parquesEsportivos = DataBase::getFactory()->getRepository('ParqueEsportivo')->findAll();

        return (empty($parquesEsportivos) ? false : $parquesEsportivos);
    }

    function delete($parqueEsportivo) {
        DataBase::getFactory()->remove($parqueEsportivo);
        
        return DataBase::getFactory()->flush();
    }
}