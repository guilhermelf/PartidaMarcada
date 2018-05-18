<?php

require (BLL . '/ParticipanteBLL.php');

class participanteController extends Controller {

    function listar() {
        $bll = new participanteBLL();

        echo $bll->getAll();
    }

    function buscarParticipante($id) {
        try {
            if (empty($_SESSION['tipo']))
                $this->AccessDenied();
            else {
                $bll = new ParticipanteBLL();

                $participante = $bll->getById($id);

                echo json_encode($participante->toJson());
            }
        } catch (Exception $ex) {
            $this->AccessDenied();
        }
    }
    
    function listarPorPartida() {
        $partida = $_POST["partida"];
        
        $bll = new ParticipanteBLL();
        
        echo $bll->getByPartida($partida);
    }
    
    function convidar() {
        $partida = $_POST["partida"];
        $participantes = $_POST["participantes"];
        
        $bll = new ParticipanteBLL();       
        
        echo json_encode($bll->convidar($participantes, $partida));
    }
    
    function buscarConvite() {
        $partida = $_POST["partida"];
        $usuario = $_SESSION['id'];
        
        $bll = new ParticipanteBLL();       

        echo json_encode($bll->buscarConvite($usuario, $partida));
    }
    
    function aceitar() {
        $id = $_POST['participante'];
        
        $bll = new ParticipanteBLL();
        
        echo $bll->aceitar($id);
    }
    
    function negar() {
        $id = $_POST['participante'];
        
        $bll = new ParticipanteBLL();
        
        echo $bll->negar($id);
    }
    
    function aguardar() {
        $id = $_POST['participante'];
        
        $bll = new ParticipanteBLL();
        
        echo $bll->aguardar($id);       
    }

    function buscarPendentes() {
        $bll = new ParticipanteBLL();
        
        echo $bll->buscarPendentes();
    }
}
