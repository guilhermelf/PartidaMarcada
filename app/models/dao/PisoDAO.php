<?php
class PisoDAO {

    function insert($piso) {
        DataBase::getFactory()->persist($piso);
        
        return DataBase::getFactory()->flush();
    }

    function update($piso) {
        DataBase::getFactory()->persist($piso);
        
        return DataBase::getFactory()->flush();
    }

    static function getById($id) {
        $piso = DataBase::getFactory()->getRepository('Piso')->find(array('id' => $id));

        return (empty($piso) ? false : $piso);
    }

    function getAll() {
        $pisos = DataBase::getFactory()->getRepository('Piso')->findAll();

        return (empty($pisos) ? false : $pisos);
    }

    function delete($piso) {
        DataBase::getFactory()->remove($piso);
        
        return DataBase::getFactory()->flush();
    }
}