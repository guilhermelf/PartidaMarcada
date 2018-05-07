<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Amigo
 *
 * @author Guilherme Longaray
 */

/**
 * Cidade
 *
 * @Entity
 * @Table(name="amigo")
 */
class Amigo {
    
     /**
     * @Id
     * @Column(type="integer", name="id_amigo")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;   
    
    /**
     * @ManyToOne(targetEntity="Usuario", cascade={"persist"})
     * @JoinColumn(name="id_usuario1", referencedColumnName="id_usuario")
     */
    private $usuario1;
    
    /**
     * @ManyToOne(targetEntity="Usuario", cascade={"persist"})
     * @JoinColumn(name="id_usuario2", referencedColumnName="id_usuario")
     */
    private $usuario2;

     /**
     * @Column(type="boolean", name="ativo")
     */
    private $ativo;
    
    function getId() {
        return $this->id;
    }

    function getUsuario1() {
        return $this->usuario1;
    }

    function getUsuario2() {
        return $this->usuario2;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario1($usuario1) {
        $this->usuario1 = $usuario1;
    }

    function setUsuario2($usuario2) {
        $this->usuario2 = $usuario2;
    }
    
    function getAtivo() {
        return $this->ativo;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }
    
    public function toJson() {
        return array(
            'id' => $this->getId(),
            'usuario1id' => $this->getUsuario1()->getId(),
            'usuario1nome' => $this->getUsuario1()->getNome()." ".$this->getUsuario1()->getSobrenome(). " (".$this->getUsuario1()->getApelido().")",
            'usuario2id' => $this->getUsuario2()->getId(),
            'usuario2nome' => $this->getUsuario2()->getNome()." ".$this->getUsuario2()->getSobrenome(). " (".$this->getUsuario2()->getApelido().")",
            'ativo' => $this->getAtivo()
        );
    }
}