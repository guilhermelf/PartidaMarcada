<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Valor
 *
 * @author Guilherme Longaray
 */

/**
 * Valor
 *
 * @Entity
 * @Table(name="valor")
 */
class Valor {
    
     /**
     * @Id
     * @Column(type="integer", name="id_valor")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @Column(type="integer", name="inicio")
     */
    private $inicio;

    /**
     * @Column(type="integer", name="final")
     */
    private $final;
    
    /**
     * @Column(type="float", name="valor")
     */
    private $valor;
    
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function getInicio() {
        return $this->inicio;
    }

    function getFinal() {
        return $this->final;
    }

    function getValor() {
        return $this->valor;
    }

    function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    function setFinal($final) {
        $this->final = $final;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }
            
    public function toJson() {
        return array(
            'id' => $this->getId(),
            'inicio' => $this->getInicio(),
            'final' => $this->getFinal(),
            'valor' => $this->getValor()
        );
    }
}