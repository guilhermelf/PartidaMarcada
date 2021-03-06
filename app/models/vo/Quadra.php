<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Quadra
 *
 * @author Guilherme Longaray
 */

/**
 * Quadra
 *
 * @Entity
 * @Table(name="quadra")
 */
class Quadra {

    public function __construct() {
        $this->esportes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->agendamentos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @Id
     * @Column(type="integer", name="id_quadra")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="ParqueEsportivo", cascade={"persist"})
     * @JoinColumn(name="id_parque_esportivo", referencedColumnName="id_parque_esportivo")
     */
    private $parqueEsportivo;

    /**
     * @ManyToOne(targetEntity="Piso", cascade={"persist"})
     * @JoinColumn(name="id_piso", referencedColumnName="id_piso")
     */
    private $piso;

    /**
     * @ManyToMany(targetEntity="Esporte")
     * @JoinTable(name="quadra_esporte",
     *      joinColumns={@JoinColumn(name="id_quadra", referencedColumnName="id_quadra")},
     *      inverseJoinColumns={@JoinColumn(name="id_esporte", referencedColumnName="id_esporte", unique=true)}
     *      )
     */
    private $esportes;

    /**
     * @Column(type="integer", name="tamanho")
     */
    private $tamanho;

    /**
     * @Column(type="integer", name="numero")
     */
    private $numero;

    /**
     * @Column(type="boolean", name="ativo")
     */
    private $ativo;
    
    /**
     * @Column(type="float", name="valor")
     */
    private $valor;

    /**
     * @OneToMany(targetEntity="Agendamento", mappedBy="quadra")
     * */
    private $agendamentos;
    
    function getAgendamentos() {
        return $this->agendamentos;
    }

    function setAgendamentos($agendamentos) {
        $this->agendamentos = $agendamentos;
    }
    
    function getValor() {
        return $this->valor;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

        
    function getNumero() {
        return $this->numero;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }   

    function getId() {
        return $this->id;
    }

    function getParqueEsportivo() {
        return $this->parqueEsportivo;
    }

    function getPiso() {
        return $this->piso;
    }

    function getTamanho() {
        return $this->tamanho;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setParqueEsportivo($parqueEsportivo) {
        $this->parqueEsportivo = $parqueEsportivo;
    }

    function setPiso($piso) {
        $this->piso = $piso;
    }

    function setTamanho($tamanho) {
        $this->tamanho = $tamanho;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    function getEsportes() {
        return $this->esportes;
    }

    function setEsportes($esportes) {
        $this->esportes = $esportes;
    }

    function addEsporte($esporte) {
        $this->esportes->add($esporte);
    }
    
    public function removeEsportes() {
        $this->esportes->clear();
    }  

    public function toJson() {

        $esportes = [];
        foreach ($this->getEsportes() as $esp) {
            $esportes[] = $esp->toJson();
        }
        
        if(empty($esportes))
            $esportes = null;    

        return array(
            'id' => $this->getId(),
            'tamanho' => $this->getTamanho(),
            'numero' => $this->getNumero(),
            'piso' => $this->getPiso()->toJson(),
            'parqueEsportivo' => $this->getParqueEsportivo()->toJson(),
            'ativo' => $this->getAtivo(),
            'valor' => $this->getValor(),
            'esportes' => $esportes
        );
    }
}