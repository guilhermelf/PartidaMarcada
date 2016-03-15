<?php
/**
 * Estado
 *
 * @Entity
 * @Table(name="estado")
 */
class Estado {

    public function __construct() {
        $this->cidades = new ArrayCollection();
    }

    /**
     * @Id
     * @Column(type="integer", name="id_estado")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column(type="string", name="nome")
     */
    private $nome;

    /**
     * @Column(type="string", name="uf")
     */
    private $uf;

    /**
     * @OneToMany(targetEntity="Cidade", mappedBy="estado")
     * */
    private $cidades;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getUf() {
        return $this->uf;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }

    function getCidades() {
        return $this->cidades;
    }

    function setCidades($cidades) {
        $this->cidades = $cidades;
    }
      
    public function toJson() {
        $cidades = [];
        foreach ($this->getCidades() as $cid) {
            $cidades[] = $cid->getNome();
        }
        
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'uf' => $this->getUf(),
            'cidades' => $cidades
        );
    }
}
