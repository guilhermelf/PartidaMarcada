<?php

require_once(DAO . '/ParticipanteDAO.php');

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
}