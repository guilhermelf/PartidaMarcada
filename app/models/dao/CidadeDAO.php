<?php

class CidadeDAO {

    function persist($cidade) {
        try {
            DataBase::getFactory()->persist($cidade);
            DataBase::getFactory()->flush();

            return DataBase::getFactory()->contains($cidade);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getById($id) {
        try {
            $cidade = DataBase::getFactory()->getRepository('Cidade')->find(array('id' => $id));

            return (empty($cidade) ? false : $cidade);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getByEstado($estado) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT c FROM Cidade c WHERE c.estado = " . $estado . " ORDER BY c.nome ASC");
            $cidades = $query->getResult();

            return (empty($cidades) ? false : $cidades);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getAll() {
        try {
            $cidades = DataBase::getFactory()->getRepository('Cidade')->findAll();

            return (empty($cidades) ? false : $cidades);
        } catch (Exception $ex) {
            return false;
        }
    }

    function delete($cidade) {
        try {
            DataBase::getFactory()->remove($cidade);

            DataBase::getFactory()->flush();

            return !DataBase::getFactory()->contains($cidade);
        } catch (Exception $ex) {
            return false;
        }
    }

}
