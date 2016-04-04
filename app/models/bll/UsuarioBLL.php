<?php

require_once(DAO . '/UsuarioDAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioBLL
 *
 * @author Guilherme Longaray
 */
class UsuarioBLL {

    public function logar($email, $senha) {
        $dao = new UsuarioDAO();

        $usuario = $dao->logar($email, $senha);

        if ($usuario) {
            $_SESSION['id'] = $usuario->getId();
            $_SESSION['nome'] = $usuario->getNome() . " " . $usuario->getSobrenome();
            $_SESSION['tipo'] = "usuario";

            return true;
        } else {
            return false;
        }
    }

    public function deslogar() {
        session_destroy();
        
        return true;
    }
}
