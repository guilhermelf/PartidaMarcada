<?php
/**
 * Teste
 *
 * @Entity
 * @Table(name="teste")
 */
class Teste2 {
    
    /**
     * @Id
     * @Column(type="integer", name="id")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @Column(type="string", name="teste")
     */
    protected $nome;
    
    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
}

