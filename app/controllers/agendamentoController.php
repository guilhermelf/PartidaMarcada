<?php
require (BLL.'/AgendamentoBLL.php');

class AgendamentoController extends Controller {
    
    
    
    function listar() {
        $bll = new agendamentoBLL();
        
        echo $bll->getAll();
    }
    
    function buscarAgendamentosPendentes() {
        $bll = new agendamentoBLL();
        
        echo $bll->buscarAgendamentosPendentes();
    }
    
    function buscarHorarios() {
        $bll = new AgendamentoBLL();
        
        try {
            $data = Retorno::invertDate($_POST['data']);      
            $quadra = $_POST['quadra'];
            
            echo json_encode($bll->buscarHorarios($quadra, $data));
        } catch (Exception $exc) {
            echo json_encode($bll->buscarHorarios());
        }           
    }
    
    function buscarHorariosQuadraData() {
        $bll = new AgendamentoBLL();
        
        try {
            $data = Retorno::invertDate($_POST['data']);      
            $quadra = $_POST['quadra'];
            
            echo json_encode($bll->buscarHorariosQuadraData($quadra, $data));
        } catch (Exception $exc) {
            echo 0;
        }           
    }
    
    function negar($id) {
        $bll = new AgendamentoBLL();
    
        echo json_encode($bll->negar($id));
    }
    
    function confirmar($id) {
        $bll = new AgendamentoBLL();
    
        echo json_encode($bll->confirmar($id));
    }
    
    function reservarHorario() {
        $bll = new AgendamentoBLL();
    
        echo json_encode($bll->reservarHorario($_POST));
    }
    
    function liberar() {
        try {
            $id = $_POST['agendamento'];
            
            $bll = new AgendamentoBLL();
    
            echo json_encode($bll->liberar($id));
        } catch (Exception $exc) {
            return false;
        }
    }
}