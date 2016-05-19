<?php

class PartidaDAO {

    function persist($partida) {
        try {
            DataBase::getFactory()->persist($partida);
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $partida = DataBase::getFactory()->getRepository('Partida')->find(array('id' => $id));

            return (empty($partida) ? false : $partida);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getAll() {
        try {
            $partidas = DataBase::getFactory()->getRepository('Partida')->findAll();

            return (empty($partidas) ? false : $partidas);
        } catch (Exception $ex) {
            return false;
        }
    }

    function delete($partida) {
        try {
            DataBase::getFactory()->remove($partida);

            DataBase::getFactory()->flush();

            return !DataBase::getFactory()->contains($partida);
        } catch (Exception $ex) {
            return false;
        }
    }
}
