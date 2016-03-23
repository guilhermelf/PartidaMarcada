<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cidade
 *
 * @author Guilherme Longaray
 */

/**
 * Cidade
 *
 * @Entity
 * @Table(name="cidade")
 */
class Cidade {
    
     /**
     * @Id
     * @Column(type="integer", name="id_cidade")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @Column(type="string", name="nome")
     */
    private $nome;
    
    /**
     * @ManyToOne(targetEntity="Estado", cascade={"persist"}, inversedBy="cidades")
     * @JoinColumn(name="id_estado", referencedColumnName="id_estado")
     */
    private $estado;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
        
    public function toJson() {
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'estado' => $this->getEstado()->toJson()
        );
    }
}
