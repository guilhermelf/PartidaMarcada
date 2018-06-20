<?php

require_once(DAO . '/ParqueEsportivoDAO.php');
require_once(BLL . '/CidadeBLL.php');
require_once(BLL . '/GeneroBLL.php');
require_once(BLL . '/VisibilidadeBLL.php');
require_once(BLL . '/EstatisticaQuadraBLL.php');

class ParqueEsportivoBLL {

    function getAll() {
        $dao = new ParqueEsportivoDAO();

        $parquesEsportivos = $dao->getAll();

        $json = [];

        if (empty($parquesEsportivos)) {
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
                $parqueEsportivo->setSenha(md5($dados['senha']));
                $parqueEsportivo->setTelefone($dados['telefone']);
                $parqueEsportivo->setServicos($dados['servicos']);
                $parqueEsportivo->setCopa($dados['copa']);
                $parqueEsportivo->setVestiario($dados['vestiario']);
                $parqueEsportivo->setChurrasqueira($dados['churrasqueira']);

                $dao = new ParqueEsportivoDAO();

                if ($dao->persist($parqueEsportivo)) {
                    Retorno::setStatus(1);
                    Retorno::setMensagem("Parque esportivo cadastrado com sucesso, efetue o login através do menu \"Quadras\"!");
                    
                    $estatisticaQuadraBLL = new EstatisticaQuadraBLL();
                    
                    $estatisticaQuadraBLL->insert($parqueEsportivo);

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
            $_SESSION['tipo'] = 'quadra';

            Retorno::setStatus(1);
            Retorno::setMensagem("Login efetuado com sucesso!");

            return Retorno::toJson();
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("E-mail e/ou senha inválido(s). Tente novamente!");

            return Retorno::toJson();
        }
    }

    public function atualizarEmail($dados) {

        if ($dados['novo_email'] == $dados['novo_email2']) {

            $dao = new ParqueEsportivoDAO();

            $parqueEsportivo = $dao->getById($_SESSION['id']);

            if ($parqueEsportivo->getEmail() == $dados['email']) {
                $parqueEsportivo->setEmail($dados['novo_email']);

                $dao->persist($parqueEsportivo);

                Retorno::setStatus(1);
                Retorno::setMensagem("E-mail alterado com sucesso!");
            } else {
                Retorno::setStatus(0);
                Retorno::setMensagem("O e-mail atual digitado não confere com o e-mail salvo no sistema. Tente novamente!");
            }

            return Retorno::toJson();
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("Os novos e-mails digitados não conferem. Tente novamente.");

            return Retorno::toJson();
        }
    }

    public function atualizarSenha($dados) {

        if ($dados['nova_senha'] == $dados['nova_senha2']) {
            if (strlen($dados['nova_senha']) > 5) {


                $dao = new ParqueEsportivoDAO();

                $parqueEsportivo = $dao->getById($_SESSION['id']);

                if ($parqueEsportivo->getSenha() == md5($dados['senha'])) {
                    $parqueEsportivo->setSenha(md5($dados['nova_senha']));

                    $dao->persist($parqueEsportivo);

                    Retorno::setStatus(1);
                    Retorno::setMensagem("Senha alterada com sucesso!");
                } else {
                    Retorno::setStatus(0);
                    Retorno::setMensagem("A senha atual digitada não confere com a senha salva no sistema. Tente novamente!");
                }

                return Retorno::toJson();
            } else {
                Retorno::setStatus(0);
                Retorno::setMensagem("A senha deve ter entre 6 e 18 caracteres. Tente novamente.");

                return Retorno::toJson();
            }
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("As novas senhas inseridas não conferem. Tente novamente.");

            return Retorno::toJson();
        }
    }

    function getById($id) {
        $dao = new ParqueEsportivoDAO();

        $parqueEsportivo = $dao->getById($id);

        return $parqueEsportivo;
    }

    public function update($dados) {
        try {
            $parqueEsportivo = $this->getById($_SESSION['id']);
            
            $CidadeBLL = new CidadeBLL();
            $cidade = $CidadeBLL->getById($dados['cidade']);

            $parqueEsportivo->setCidade($cidade);
            $parqueEsportivo->setNome($dados['nome']);
            $parqueEsportivo->setSite($dados['site']);
            $parqueEsportivo->setCep($dados['cep']);
            $parqueEsportivo->setAtivo(1);
            $parqueEsportivo->setDdd($dados['ddd']);
            $parqueEsportivo->setEndereco($dados['endereco']);
            $parqueEsportivo->setNumero($dados['numero']);
            $parqueEsportivo->setTelefone($dados['telefone']);
            $parqueEsportivo->setServicos($dados['servicos']);
            $parqueEsportivo->setCopa($dados['copa']);
            $parqueEsportivo->setVestiario($dados['vestiario']);
            $parqueEsportivo->setChurrasqueira($dados['churrasqueira']);

            $dao = new ParqueEsportivoDAO();

            if ($dao->persist($parqueEsportivo)) {
                Retorno::setStatus(1);
                Retorno::setMensagem("Perfil atualizado com sucesso!");

                return Retorno::toJson();
            } else {
                Retorno::setStatus(0);
                Retorno::setMensagem("Erro ao atualizar perfil!");

                return Retorno::toJson();
            }
        } catch (Exception $ex) {
            Retorno::setStatus(0);
            return Retorno::setMensagem("Erro ao atualizar perfil!");
        }
    }

    function pesquisar($dados) {
        try {
            $dao = new ParqueEsportivoDAO();

            $parquesEsportivos = $dao->pesquisar($dados);
            
            $json = [];
            if (empty($parquesEsportivos)) {
                return json_encode(false);
            } else {     
                foreach ($parquesEsportivos as $parque) {   
                    $parqueDAO = new ParqueEsportivoDAO();

                    $parqueEsportivo = $parqueDAO->getById($parque['1']);              
                    $json[] = $parqueEsportivo->toJson();
                }
                return $json;
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    function isOnline() {
        try {
            $parque = $this->getById($_SESSION['id']);
            
            return ($parque->getServicos() ? 1 : 0);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
