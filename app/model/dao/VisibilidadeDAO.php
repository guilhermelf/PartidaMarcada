<?php
class VisibilidadeDAO {

    function insert($visibilidade) {
        DataBase::getFactory()->persist($visibilidade);
        
        return DataBase::getFactory()->flush();
    }

    function update($visibilidade) {
        DataBase::getFactory()->persist($visibilidade);
        return DataBase::getFactory()->flush();
    }

    static function getById($id) {
        $visibilidade = DataBase::getFactory()->getRepository('Visibilidade')->find(array('id' => $id));

        return (empty($visibilidade) ? false : $visibilidade);
    }

    function getAll() {
        $visibilidades = DataBase::getFactory()->getRepository('Visibilidade')->findAll();

        return (empty($visibilidades) ? false : $visibilidades);
    }

    function delete($visibilidade) {
        DataBase::getFactory()->remove($visibilidade);
        
        return DataBase::getFactory()->flush();
    }
}