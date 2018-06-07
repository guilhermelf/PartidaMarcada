<?php
/**
 * Usuario
 *
 * @Entity
 * @Table(name="usuario")
 */
class Usuario {
   
    /**
     * @Id
     * @Column(type="integer", name="id_usuario")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @Column(type="string", name="nome")
     */
    private $nome;
    
    /**
     * @Column(type="string", name="apelido")
     */
    private $apelido;
    
    /**
     * @Column(type="boolean", name="ativo")
     */
    private $ativo;
    
    /**
     * @Column(type="string", name="cep")
     */
    private $cep;
    
    /**
     * @Column(type="integer", name="ddd")
     */
    private $ddd;
    
    /**
     * @Column(type="date", name="dt_nascimento")
     */
    private $DataNascimento;
    
    /**
     * @Column(type="string", name="email")
     */
    private $email;
    
    /**
     * @Column(type="string", name="endereco")
     */
    private $endereco;
    
    /**
     * @Column(type="integer", name="numero")
     */
    private $numero;
    
    /**
     * @Column(type="string", name="telefone")
     */
    private $telefone;
    
    /**
     * @Column(type="string", name="sobrenome")
     */
    private $sobrenome;
    
    /**
     * @Column(type="string", name="senha")
     */
    private $senha;
    
    /**
     * @ManyToOne(targetEntity="Cidade", cascade={"persist"}, inversedBy="usuarios")
     * @JoinColumn(name="id_cidade", referencedColumnName="id_cidade")
     */
    private $cidade;
    
    /**
     * @ManyToOne(targetEntity="Genero", cascade={"persist"})
     * @JoinColumn(name="id_genero", referencedColumnName="id_genero")
     */
    private $genero;
    
    /**
     * @OneToOne(targetEntity="EstatisticaAtleta", mappedBy="usuario")
     */
    private $estatistica;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getApelido() {
        return $this->apelido;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function getCep() {
        return $this->cep;
    }

    function getDdd() {
        return $this->ddd;
    }

    function getDataNascimento() {
        return $this->DataNascimento;
    }

    function getEmail() {
        return $this->email;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getNumero() {
        return $this->numero;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getSenha() {
        return $this->senha;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getGenero() {
        return $this->genero;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setDdd($ddd) {
        $this->ddd = $ddd;
    }

    function setDataNascimento($DataNascimento) {
        $this->DataNascimento = $DataNascimento;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }
    
    function getEstatistica() {
        return $this->estatistica;
    }

    function setEstatistica($estatistica) {
        $this->estatistica = $estatistica;
    }
    
    public function toJson() {
        if($this->getEstatistica() != null)
            $estatistica = $this->getEstatistica()->toJson();
        else
            $estatistica = null;
        
        return array(        
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'cidade' => $this->getCidade()->toJson(),
            'sobrenome' => $this->getSobrenome(),
            'apelido' => $this->getApelido(),
            'dataNascimento' => date_format($this->getDataNascimento(), 'd/m/Y'),
            'cep' => $this->getCep(),
            'ddd' => $this->getDdd(),
            'endereco' => $this->getEndereco(),
            'numero' => $this->getNumero(),        
            'ativo' => $this->getAtivo(),
            'email' => $this->getEmail(),
            'telefone' => $this->getTelefone(),
            'senha' => $this->getSenha(),
            'genero' => $this->getGenero()->toJson(),
            'estatistica' => $estatistica
        );
    } 
}