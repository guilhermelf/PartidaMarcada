<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Visibilidade
 *
 * @author Guilherme Longaray
 */

/**
 * Visibilidade
 *
 * @Entity
 * @Table(name="visibilidade")
 */
class Visibilidade {
    
     /**
     * @Id
     * @Column(type="integer", name="id_visibilidade")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @Column(type="string", name="nome")
     */
    private $nome;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
        
    public function toJson() {
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
        );
    }
}