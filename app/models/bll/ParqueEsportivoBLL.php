<?php
require_once(DAO . '/ParqueEsportivoDAO.php');
require_once(BLL . '/CidadeBLL.php');
require_once(BLL . '/GeneroBLL.php');
require_once(BLL . '/VisibilidadeBLL.php');

class ParqueEsportivoBLL {
    function getAll() {
        $dao = new ParqueEsportivoDAO();
        
        $parquesEsportivos = $dao->getAll();
       
        $json = [];

        if(empty($parquesEsportivos)) {
            echo "vazio!";
        } else {
            foreach ($parquesEsportivos as $parqueEsportivo) {                         
                $json[] = $parqueEsportivo->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    public function deslogar() {
        session_destroy();

        return true;
    }
    
    function insert($dados) {
        try {
            if (empty($dados)) {
                return "!vazio";
            } else {
                $CidadeBLL = new CidadeBLL();
                $cidade = $CidadeBLL->getById($dados['cidade']);

                $parqueEsportivo = new ParqueEsportivo();

                $parqueEsportivo->setCidade($cidade);
                $parqueEsportivo->setNome($dados['nome']);
                $parqueEsportivo->setSite($dados['site']);
                $parqueEsportivo->setCep($dados['cep']);
                $parqueEsportivo->setAtivo(1);
                $parqueEsportivo->setDdd($dados['ddd']);
                $parqueEsportivo->setEmail($dados['email']);
                $parqueEsportivo->setEndereco($dados['endereco']);
                $parqueEsportivo->setNumero($dados['numero']);
                $parqueEsportivo->setSenha($dados['senha']);
                $parqueEsportivo->setTelefone($dados['telefone']);
                $parqueEsportivo->setServicos($dados['servicos']);
                $parqueEsportivo->setCopa($dados['copa']);
                $parqueEsportivo->setVestiario($dados['vestiario']);
                $parqueEsportivo->setChurrasqueira($dados['churrasqueira']);

                $dao = new ParqueEsportivoDAO();

                if ($dao->persist($parqueEsportivo)) {
                    Retorno::setStatus(1);
                    Retorno::setMensagem("Parque esportivo cadastrado com sucesso, efetue o login através do menu \"Quadras\"!");

                    return Retorno::toJson();
                } else {
                    Retorno::setStatus(0);
                    Retorno::setMensagem("Erro ao cadastrar parque esportivo no sistema!");

                    return Retorno::toJson();
                }
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function logar($email, $senha) {
        $dao = new ParqueEsportivoDAO();

        $parqueEsportivo = $dao->logar($email, $senha);

        if ($parqueEsportivo) {
            $_SESSION['id'] = $parqueEsportivo->getId();
            $_SESSION['nome'] = $parqueEsportivo->getNome();
            $_SESSION['tipo'] = "quadra";

            Retorno::setStatus(1);
            Retorno::setMensagem("Login efetuado com sucesso!");

            return Retorno::toJson();
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("E-mail e/ou senha inválido(s). Tente novamente!");

            return Retorno::toJson();
        }
    }
}