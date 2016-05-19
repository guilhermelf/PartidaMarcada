<?php

require_once(DAO . '/AmigoDAO.php');
require_once(BLL . '/UsuarioBLL.php');

class AmigoBLL {

    function aceitarAmizade($amigo) {

        $bll = new AmigoBLL;
        $amigo = $bll->getById($amigo['id']);
        $amigo->setAtivo(1);

        $dao = new AmigoDAO();

        if ($dao->persist($amigo)) {
            Retorno::setStatus(1);
            Retorno::setMensagem("Amizade aceita!");

            return Retorno::toJson();
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("Erro ao adicionar amigo!");

            return Retorno::toJson();
        }
    }

    function excluirAmizade($amigo) {

        $bll = new AmigoBLL;
        $amigo = $bll->getById($amigo['id']);

        $dao = new AmigoDAO();

        if ($dao->delete($amigo)) {
            Retorno::setStatus(1);
            Retorno::setMensagem("Amizade rejeitada!");

            return Retorno::toJson();
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("Erro ao rejeitar amizade!");

            return Retorno::toJson();
        }
    }

    function amizadeExiste($dados) {

        $UsuarioBLL = new UsuarioBLL();
        $usuario = $UsuarioBLL->getById($dados['usuario']);

        $bll = new UsuarioBLL;
        $usuarioLogado = $UsuarioBLL->getById($_SESSION['id']);

        if ($usuarioLogado == $usuario) {
            return true;
        } else {
            $dao = new AmigoDAO();

            return $dao->isFriend($usuarioLogado->getId(), $usuario->getId());
        }
    }

    function amizadesPendentes() {
        $bll = new UsuarioBLL;
        $usuarioLogado = $bll->getById($_SESSION['id']);

        $dao = new AmigoDAO();

        $dados = $dao->amizadesPendentes($usuarioLogado->getId());

        $amizades = [];

        if (empty($dados)) {
            return 0;
        } else {
            foreach ($dados as $value) {
                $amizades[] = $value->toJson();
            }

            return json_encode($amizades);
        }

        return null;
    }

    function insert($dados) {
        try {
            if (empty($dados)) {
                return "!vazio";
            } else {
                $UsuarioBLL = new UsuarioBLL();
                $usuario = $UsuarioBLL->getById($dados['usuario']);

                $amigo = new Amigo();

                $bll = new UsuarioBLL;
                $usuarioLogado = $UsuarioBLL->getById($_SESSION['id']);

                $amigo->setUsuario2($usuario);
                $amigo->setAtivo(0);
                $amigo->setUsuario1($usuarioLogado);

                $dao = new AmigoDAO();

                if ($dao->persist($amigo)) {
                    Retorno::setStatus(1);
                    Retorno::setMensagem("Amizade solicitada, ele aparecerá na lista assim que aceitar a solicitação.");

                    return Retorno::toJson();
                } else {
                    Retorno::setStatus(0);
                    Retorno::setMensagem("Erro ao adicionar amigo!");

                    return Retorno::toJson();
                }
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    function getById($id) {
        $dao = new AmigoDAO();

        $amigo = $dao->getById($id);

        return $amigo;
    }

}
