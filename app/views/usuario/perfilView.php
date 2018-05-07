<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/css/metro-all.css" />
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/js/metro.js"></script>
        <title>Partida Marcada</title>
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
        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <h3><?php echo $dados->getNome() . " " . $dados->getSobrenome(); ?><?php echo ($dados->getApelido() != "" ? " (" . $dados->getApelido() . ")" : ""); ?></h3>
            <hr />
            <br />
            <div class="row">
                <div class="cell-sm-12">
                    <span class="perfil-label">Data de nascimento: </span> <?php echo date_format($dados->getDataNascimento(), 'd/m/Y'); ?>
                </div>
            </div>
            <div class="row">
                <div class="cell-sm-12">
                    <span class="perfil-label">Cidade: </span> <?php echo $dados->getCidade()->getNome(); ?>
                </div>  
            </div>
            <div class="row">
                <div class="cell-sm-12">
                    <span class="perfil-label">Estado: </span> <?php echo $dados->getCidade()->getEstado()->getNome(); ?>
                </div>    
            </div>
            <br />
            <h4>Estatísticas</h4>
            <hr />
            Módulo ainda não terminado. 

            <br />
            <br />
            <h4>Avaliações</h4>
            <hr />

                Informações gráficas levando em conta as avaliações recebidas dos outros usuários. (Próxima Sprint)

                <form id="form-adicionar-amigo">
                <br />
                <div class="row">
                    <div class="cell-sm-12">
                        <input type="button" class="button bg-lightBlue place-right" value="Adicionar aos amigos" id="btn-adicionar-amigo">
                        <input type="hidden" name="usuario" value="<?php echo $dados->getId(); ?>">
                    </div>
                </div>
                <br />&nbsp;
                </form>
            </div>
        </div>
    </body>
</html>