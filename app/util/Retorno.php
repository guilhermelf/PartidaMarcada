<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Retorno
 *
 * @author Guilherme Longaray
 */
class Retorno {
    private $status;
    private $mensagem;
    
    function getStatus() {
        return $this->status;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }
}
