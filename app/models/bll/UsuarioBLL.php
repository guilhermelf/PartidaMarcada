<?php

require_once(DAO . '/UsuarioDAO.php');

require_once(BLL . '/CidadeBLL.php');
require_once(BLL . '/GeneroBLL.php');
require_once(BLL . '/VisibilidadeBLL.php');
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

    public function insert($dados) {
        try {
            if (empty($dados)) {
                return "!vazio";
            } else {
                $cidadeBLL = new CidadeBLL();
                $cidade = $cidadeBLL->getById($dados['cidade']);

                $generoBLL = new GeneroBLL();
                $genero = $generoBLL->getById($dados['genero']);

                $visibilidadeBLL = new VisibilidadeBLL();
                $visibilidade = $visibilidadeBLL->getById($dados['visibilidade']);

                $usuario = new Usuario();

                $usuario->setNome($dados['nome']);
                $usuario->setApelido($dados['apelido']);
                $usuario->setCep($dados['cep']);
                $usuario->setAtivo(1);
                $usuario->setCidade($cidade);
                $usuario->setDataNascimento(new \DateTime($dados['dt_nascimento']));
                $usuario->setMostrarEndereco($dados['mostrar_endereco']);
                $usuario->setMostrarTelefone($dados['mostrar_telefone']);
                $usuario->setDdd($dados['ddd']);
                $usuario->setEmail($dados['email']);
                $usuario->setEndereco($dados['endereco']);
                $usuario->setGenero($genero);
                $usuario->setNumero($dados['numero']);
                $usuario->setSenha($dados['senha']);
                $usuario->setSobrenome($dados['sobrenome']);
                $usuario->setTelefone($dados['telefone']);
                $usuario->setVisibilidade($visibilidade);

                $dao = new UsuarioDAO();

                echo $dao->persist($usuario);
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
