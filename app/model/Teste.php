<?php

class Estado3 {
    


    private $nome;
    

    private $uf;


    function getNome() {
        return $this->nome;
    }

    function getUf() {
        return $this->uf;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }
}

