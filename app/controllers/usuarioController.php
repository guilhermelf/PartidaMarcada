<?php
    require (BLL . '/UsuarioBLL.php');
    
class UsuarioController extends Controller {
    
    function index_action() {
        if(isset($_SESSION['tipo'])) {
            if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != "usuario") {
                $this->AccessDenied();
            } else {
                $this->View('usuario/index');
            }
        } else {
            $this->AccessDenied();
        }
    }

    function amigos() {
        if(isset($_SESSION['tipo'])) {
            if (empty($_SESSION['tipo']) and $_SESSION['tipo'] != "usuario") {
                $this->AccessDenied();
            } else {
                $this->View('usuario/amigos');
            }
        } else {
            $this->AccessDenied();
        }
    }

    function cadastrar() {
        $this->View('usuario/cadastrar');
    }

    function logar() {
        
        if (empty($_POST)) {
            echo "erro";
        } else {
            $email = $_POST['usuario-email'];
            $senha = $_POST['usuario-senha'];

            $usuario = new UsuarioBLL();

            echo json_encode($usuario->logar($email, $senha));
        }
    }

    function deslogar() {
        $usuario = new UsuarioBLL();
        $usuario->deslogar();
    }

    function salvar() {
        $usuario = new UsuarioBLL();

        echo json_encode($usuario->insert($_POST));
    }

    function alterarSenha() {
        if(isset($_SESSION['tipo'])) {
            if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario')
                $this->AccessDenied();
            else
                $this->View('usuario/alterarSenha');
        } else {
            $this->AccessDenied();
        }            
    }

    function atualizarPerfil() {
        if(isset($_SESSION['tipo'])) {
            if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario')
                $this->AccessDenied();
            else
                $this->View('usuario/atualizarPerfil');
        } else {
            $this->AccessDenied();
        }
    }

    function alterarEmail() {
        if(isset($_SESSION['tipo'])) {
            if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario')
                $this->AccessDenied();
            else
                $this->View('usuario/alterarEmail');
        } else {
            $this->AccessDenied();
        }
    }

    function atualizarEmail() {
        if(isset($_SESSION['tipo'])) {
            if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario')
                $this->AccessDenied();
            else {
                $bll = new UsuarioBLL();

                echo json_encode($bll->atualizarEmail($_POST));
            }
        } else {
            $this->AccessDenied();
        }
    }

    function atualizarSenha() {
        if(isset($_SESSION['tipo'])) {
            if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario')
                $this->AccessDenied();
            else {
                $bll = new UsuarioBLL();

                echo json_encode($bll->atualizarSenha($_POST));
            }
        } else {
            $this->AccessDenied();
        }
    }

    function atualizar() {
        if(isset($_SESSION['tipo'])) {
            if (empty($_SESSION['tipo']) or $_SESSION['tipo'] != 'usuario') {
                $this->AccessDenied();
            } else {
                $bll = new UsuarioBLL();

                echo json_encode($bll->update($_POST));
            }
        } else {
            $this->AccessDenied();
        }
    }

    function perfil($id) {
        if (empty($_SESSION['tipo']))
            $this->AccessDenied();
        else {

            $bll = new UsuarioBLL();
            $usuario = $bll->getById($id);
            if (!empty($usuario))
                $this->View('usuario/perfil', $usuario);
            else
                $this->View('naoencontrada');
        }
    }

    function buscarUsuario() {
        $bll = new UsuarioBLL();

        $usuario = $bll->getById($_SESSION['id']);

        echo json_encode($usuario->toJson());
    }

    function pesquisar() {
        if (empty($_SESSION['tipo']))
            $this->AccessDenied();
        else {
            $bll = new UsuarioBLL();

            echo $bll->pesquisar($_POST);
        }
    }
}
