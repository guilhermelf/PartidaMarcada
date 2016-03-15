<?php

class CidadeDAO {

    function insert($cidade) {
        DataBase::getFactory()->persist($cidade);
        DataBase::getFactory()->flush();
    }

    function update($cidade) {
        DataBase::getFactory()->persist($cidade);
        return DataBase::getFactory()->flush();
    }

    static function getById($id) {
        $cidade = DataBase::getFactory()->getRepository('Cidade')->find(array('id' => $id));

        return (empty($cidade) ? false : $cidade);
    }

    function getAll() {
        $cidades = DataBase::getFactory()->getRepository('Cidade')->findAll();

        return (empty($cidades) ? false : $cidades);
    }

    static function getByEstado($estado) {
        $query = DataBase::getFactory()->createQuery("SELECT c FROM Cidade c WHERE c.estado = " . $estado->getId());
        $cidades = $query->getResult();

        return (empty($cidades) ? false : $cidades);
    }

    function delete($cidade) {
        DataBase::getFactory()->remove($cidade);
        return DataBase::getFactory()->flush();
    }

}
