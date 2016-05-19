<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/build/css/metro.css" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-icons.css" rel="stylesheet" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-schemes.css" rel="stylesheet">
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-responsive.css" rel="stylesheet">
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/build/js/metro.js"></script>
        <title>PartidaMarcada.com</title>
        <script>
            $(document).ready(function () {
                $('#form-adicionar-amigo').hide();
                verificarAmizade();

                function verificarAmizade() {
                    //testar se já existe amizade
                    $.ajax({
                        type: "post",
                        data: $("#form-adicionar-amigo").serialize(),
                        url: "/partidamarcada/amigo/amizadeExistente",
                        success: function (resposta) {
                            console.log(resposta);
                            if (resposta == 1) {
                                $('#form-adicionar-amigo').hide();
                            } else {
                                $('#form-adicionar-amigo').show();
                            }
                        }
                    });
                }

                //adicionar amigo
                $("#btn-adicionar-amigo").on('click', function () {
                    $.ajax({
                        type: "post",
                        dataType: 'json',
                        data: $("#form-adicionar-amigo").serialize(),
                        url: "/partidamarcada/amigo/salvar",
                        success: function (resposta) {
                            if (resposta.status) {
                                $(".resposta-titulo").html("Sucesso");
                                $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                                $(".resposta-mensagem").html(resposta.mensagem);

                                $("#resposta").data('dialog').open();
                                
                                setTimeout(function () {
                                    location.reload()
                                }, 2000);
                                
                            } else {
                                $(".resposta-titulo").html("Erro");
                                $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                                $(".resposta-mensagem").html(resposta.mensagem);

                                $("#resposta").data('dialog').open();
                            }
                            console.log(resposta);
                        }
                    });
                })
            });
        </script>

    </head>
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo">aa</h3>

            <p class="resposta-mensagem">aa</p>
        </div>

        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div class="conteudo">
            <div class="form-usuario-adicionar grid">

                <h3><?php echo $dados->getNome() . " " . $dados->getSobrenome(); ?><?php echo ($dados->getApelido() != "" ? " (" . $dados->getApelido() . ")" : ""); ?></h3>
                <hr />
                <br />
                <div class="row cells2">
                    <div class="cell">
                        <span class="perfil-label">Data de nascimento: </span> <?php echo date_format($dados->getDataNascimento(), 'd/m/Y'); ?>
                    </div>
                    <!-- input[type=password] -->
                    <form id="form-adicionar-amigo">
                        <div class="cell">
                            <input type="button" class="bg-lightBlue place-right" value="Adicionar aos amigos" id="btn-adicionar-amigo">
                            <input type="hidden" name="usuario" value="<?php echo $dados->getId(); ?>">
                        </div>
                    </form>
                </div>
                <?php if ($dados->getMostrarEndereco()) { ?>
                    <div class="row cells3">
                        <div class="cell">
                            <span class="perfil-label">Endereço: </span> <?php echo $dados->getEndereco() . ", " . $dados->getNumero(); ?>
                        </div>
                        <div class="cell">
                            <span class="perfil-label">Estado: </span> <?php echo $dados->getCidade()->getEstado()->getNome(); ?>
                        </div>
                        <div class="cell">
                            <span class="perfil-label">Cidade: </span> <?php echo $dados->getCidade()->getNome(); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($dados->getMostrarTelefone()) { ?>
                    <div class="row cells3">
                        <div class="cell">
                            <span class="perfil-label">Telefone: </span> <?php echo "(" . $dados->getDDD() . ") " . $dados->getNumero(); ?>
                        </div>                     
                        <div class="cell">
                            <span class="perfil-label">E-mail: </span> <?php echo $dados->getEmail(); ?>
                        </div>
                    </div>
                <?php } ?>      
                <br />
                <h4>Estatísticas</h4>
                <hr />
                Módulo ainda não terminado. 

                <br />
                <br />
                <h4>Avaliações</h4>
                <hr />

                Informações gráficas levando em conta as avaliações recebidas dos outros usuários. (Próxima Sprint)
            </div>
        </div>
    </div>
</div>
</body>
</html>