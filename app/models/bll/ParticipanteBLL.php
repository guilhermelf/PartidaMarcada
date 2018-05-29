<?php
require_once(DAO . '/ParticipanteDAO.php');
require_once(DAO . '/EstatisticaAtletaDAO.php');
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
    
    function participantePediu($participante, $partida) {
        $dao = new ParticipanteDAO();

        return $dao->participantePediu($participante, $partida);
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
    
    function buscarConvite($usuario, $partida) {
        $dao = new ParticipanteDAO();

        $participantes = $dao->getParticipante($usuario, $partida);
        
        if(!$participantes) {
            return false;
        } else {
            foreach ($participantes as $participante) {                         
                $json[] = $participante->toJson();
            }
            
            return $json;
        }
    } 
    
    function aceitar($id) {
        $dao = new ParticipanteDAO();

        $participante = $dao->getById($id);
        
        $participante->setStatus(1);

        $estatistica = $participante->getUsuario()->getEstatistica();
        $estatistica->setPontos($estatistica->getPontos() + 10);
        $estatistica->setParticipacoes($estatistica->getParticipacoes() + 1);
        
        $estatisticaDAO = new EstatisticaAtletaDAO();
        
        $estatisticaDAO->persist($estatistica);
        
        return $dao->persist($participante);
    }
    
    function negar($id) {
        $dao = new ParticipanteDAO();

        $participante = $dao->getById($id);
        
        if($participante->getStatus() == 1) {
            $estatistica = $participante->getUsuario()->getEstatistica();
            $estatistica->setPontos($estatistica->getPontos() - 10);
            $estatistica->setParticipacoes($estatistica->getParticipacoes() - 1);

            $estatisticaDAO = new EstatisticaAtletaDAO();

            $estatisticaDAO->persist($estatistica);
        }
        
        $participante->setStatus(2);

        return $dao->persist($participante);
    }
    
    function aguardar($id) {
        $dao = new ParticipanteDAO();

        $participante = $dao->getById($id);
        
        if($participante->getStatus() == 1) {
            $estatistica = $participante->getUsuario()->getEstatistica();
            $estatistica->setPontos($estatistica->getPontos() - 10);
            $estatistica->setParticipacoes($estatistica->getParticipacoes() - 1);

            $estatisticaDAO = new EstatisticaAtletaDAO();

            $estatisticaDAO->persist($estatistica);
        }
        
        $participante->setStatus(0);

        return $dao->persist($participante);
    }
    
    function buscarPendentes() {
        $dao = new ParticipanteDAO();

        $participantes = $dao->getPendentes($_SESSION['id']);

        $json = [];

        if (empty($participantes)) {
            return 0;
        } else {
            foreach ($participantes as $participante) {
                $json[] = $participante->getPartida()->toJson();
            }

            return json_encode($json);
        }
    }
    
    function candidatar($partida) {
        $dao = new ParticipanteDAO();
        $bll = new PartidaBLL();
        $usuarioBLL = new UsuarioBLL();
        
        $partida = $bll->getById($partida);
        $usuario = $usuarioBLL->getById($_SESSION['id']);
        
        $participante = new Participante();
        
        $participante->setPartida($partida);
        $participante->setStatus(3);
        $participante->setUsuario($usuario);

        return $dao->persist($participante);
    }
    
    function aceitarCandidato($participante) {
        $dao = new ParticipanteDAO();
        $bll = new ParticipanteBLL();
        
        $participante = $bll->getById($participante);
        $participante->setStatus(1);
        
        return $dao->persist($participante);
    }
    
    function negarCandidato($participante) {
        $dao = new ParticipanteDAO();
        $bll = new ParticipanteBLL();
        
        $participante = $bll->getById($participante);
        
        return $dao->delete($participante);
    }
}