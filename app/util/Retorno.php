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
    static private $status;
    static private $mensagem;
    
    static function getStatus() {
        return self::$status;
    }

    static function getMensagem() {
        return self::$mensagem;
    }

    static function setStatus($status) {
        self::$status = $status;
    }

    static function setMensagem($mensagem) {
        self::$mensagem = $mensagem;
    }
    
    static function toJson() {
        return array(
            'status' => self::getStatus(),
            'mensagem' => self::getMensagem()
        );
    }
    
    static function invertDate($data){
        if(count(explode("/",$data)) > 1){
            return implode("-",array_reverse(explode("/",$data)));
        }elseif(count(explode("-",$data)) > 1){
            return implode("/",array_reverse(explode("-",$data)));
        }
    }
}
