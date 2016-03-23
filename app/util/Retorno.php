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
    
    static function getStatus() {
        return $this->status;
    }

    static function getMensagem() {
        return $this->mensagem;
    }

    static function setStatus($status) {
        $this->status = $status;
    }

    static function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }
}
