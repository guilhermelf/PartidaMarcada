<?php
require (BLL.'/AgendamentoBLL.php');

class AgendamentoController extends Controller {
    
    
    
    function listar() {
        $bll = new agendamentoBLL();
        
        echo $bll->getAll();
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
}