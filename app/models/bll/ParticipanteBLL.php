<?php
require_once(DAO . '/ParticipanteDAO.php');
require_once(BLL . '/UsuarioBLL.php');
require_once(BLL . '/PartidaBLL.php');

class ParticipanteBLL {

    function insert($participante) {
        try {
            if (empty($participante)) {
                return "!vazio";
            } else {
                $dao = new ParticipanteDAO();

                if ($dao->persist($participante)) {
                    Retorno::setStatus(1);
                    Retorno::setMensagem("Convite enviado com sucesso!.");

                    return Retorno::toJson();
                } else {
                    Retorno::setStatus(0);
                    Retorno::setMensagem("Erro ao convidar atleta!");

                    return Retorno::toJson();
                }
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    function getAll() {
        $dao = new ParticipanteDAO();

        $participantes = $dao->getAll();

        $json = [];

        if (empty($participantes)) {
            echo "vazio!";
        } else {
            foreach ($participantes as $participante) {
                $json[] = $participante->toJson();
            }

            return json_encode($json);
        }
    }
    
    function participanteExiste($participante, $partida) {
        $dao = new ParticipanteDAO();

        return $dao->getByParticipantePartida($participante, $partida);
    }
    
    function getById($id) {
        $dao = new ParticipanteDAO();

        $participante = $dao->getById($id);

        return $participante;
    }
    
    function getByPartida($partida) {
        $dao = new ParticipanteDAO();
        
        $participantes = $dao->getByPartida($partida);
       
        $json = [];

        if(empty($participantes)) {
            echo "vazio!";
        } else {
            foreach ($participantes as $participante) {                         
                $json[] = $participante->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function convidar($participantes, $partida) {
        $bll = new PartidaBLL();
        $pa = $bll->getById($partida);
        
        foreach ($participantes as $participante) {
            $bll = new UsuarioBLL();
            $usuario = $bll->getById($participante);
            
            $part = new Participante();
   
            $part->setStatus(0);
            $part->setPartida($pa);
            $part->setUsuario($usuario);
            
            $this->insert($part);
        }        
        
        Retorno::setStatus(1);
        Retorno::setMensagem("Convite(s) enviado(s) com sucesso!.");
        
        return Retorno::toJson();
    }
}