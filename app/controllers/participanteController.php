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
}
