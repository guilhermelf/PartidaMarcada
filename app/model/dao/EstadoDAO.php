<?php
class EstadoDAO {

    function insert($estado) {
        DataBase::getFactory()->persist($estado);
        DataBase::getFactory()->flush();
    }

    function update($estado) {
        DataBase::getFactory()->persist($estado);
        return  DataBase::getFactory()->flush();
    }

    static function getById($id) {
        $estado =  DataBase::getFactory()->getRepository('Estado')->find(array('id' => $id));

        return (empty($estado) ? false : $estado);
    }

    function getAll() {
        $estados = DataBase::getFactory()->getRepository('Estado')->findAll();

        return (empty($estados) ? false : $estados);
    }

    function delete($estado) {
        DataBase::getFactory()->remove($estado);
        return DataBase::getFactory()->flush();
    }
}