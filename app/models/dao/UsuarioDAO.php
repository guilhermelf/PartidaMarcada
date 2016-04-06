<?php

class UsuarioDAO {

    function persist($usuario) {
        try {
            DataBase::getFactory()->persist($usuario);
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $usuario = DataBase::getFactory()->getRepository('Usuario')->find(array('id' => $id));

            return (empty($usuario) ? false : $usuario);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getAll() {
        try {
            $usuarios = DataBase::getFactory()->getRepository('Usuario')->findAll();

            return (empty($usuarios) ? false : $usuarios);
        } catch (Exception $ex) {
            return false;
        }
    }

    function delete($usuario) {
        try {
            DataBase::getFactory()->remove($usuario);

            DataBase::getFactory()->flush();

            return !DataBase::getFactory()->contains($usuario);
        } catch (Exception $ex) {
            return false;
        }
    }

    function logar($email, $senha) {
        try {
            $usuario = DataBase::getFactory()->getRepository('Usuario')->findOneBy(array('email' => $email, 'senha' => $senha));
             
            return (empty($usuario) ? false : $usuario);
        } catch (Exception $ex) {
            return false;
        }  
    }
}
