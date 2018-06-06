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
        <?php if($_SESSION['tipo'] == 'usuario') {
            include 'app/views/header/headerUsuario.php';
         } else {
            include 'app/views/header/headerQuadra.php';
         } ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <h3><?php echo $dados->getNome() . " " . $dados->getSobrenome(); ?><?php echo ($dados->getApelido() != "" ? " (" . $dados->getApelido() . ")" : ""); ?></h3>
            <hr />
            <?php 
                $badges = false;

                if($dados->getEstatistica()->getHabilidade()/$dados->getEstatistica()->getAvaliacoes() > 4) {
                    echo "<img class='badge' src='../../img/badges/crown.png' title='Craque' width='50px'>";
                    $badges = true;
                }
                if($dados->getEstatistica()->getComportamento()/$dados->getEstatistica()->getAvaliacoes() > 4) {
                    echo "<img class='badge' src='../../img/badges/like.png' title='Comportamento exemplar' width='50px'>";
                    $badges = true;
                }
                if($dados->getEstatistica()->getPontualidade()/$dados->getEstatistica()->getAvaliacoes() > 4) {
                    echo "<img class='badge' src='../../img/badges/clock.png' title='Pontual' width='50px'>";
                    $badges = true;
                }

                if($badges) {
                    echo "<br /><hr />";
                }
            ?>
            <br />
            <div class="row">
                <div class="cell-sm-6">
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
            <div class="row">
                <div class="cell-sm-12">
                    <span class="perfil-label">Partidas organizadas: </span> <?php echo $dados->getEstatistica()->getPartidasMarcadas(); ?>
                </div>    
            </div>
            <div class="row">
                <div class="cell-sm-12">
                    <span class="perfil-label">Partidas: </span> <?php echo $dados->getEstatistica()->getParticipacoes(); ?>
                </div>    
            </div>
            <br />
            <h4>Avaliações</h4>
            <hr />
            <?php if($dados->getEstatistica()->getAvaliacoes() == 0) {?>
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Atleta ainda não foi avaliado por outros atletas</span>
                    </div>    
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Comportamento: </span><span title="<?php echo ($dados->getEstatistica()->getComportamento()/$dados->getEstatistica()->getAvaliacoes()); ?>"><input data-static="true" data-role="rating" data-value="<?php echo ($dados->getEstatistica()->getComportamento()/$dados->getEstatistica()->getAvaliacoes()); ?>"></span>
                    </div>    
                </div>
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Habilidade: </span><span title="<?php echo ($dados->getEstatistica()->getHabilidade()/$dados->getEstatistica()->getAvaliacoes()); ?>"><input data-static="true" data-role="rating" data-value="<?php echo ($dados->getEstatistica()->getHabilidade()/$dados->getEstatistica()->getAvaliacoes()); ?>"></span>
                    </div>    
                </div>
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Pontualidade: </span><span title="<?php echo ($dados->getEstatistica()->getPontualidade()/$dados->getEstatistica()->getAvaliacoes()); ?>"><input data-static="true" data-role="rating" data-value="<?php echo ($dados->getEstatistica()->getPontualidade()/$dados->getEstatistica()->getAvaliacoes()); ?>"></span>
                    </div>    
                </div>
                <div class="row">
                    <div class="cell-sm-12">
                        <span>Total de <?php echo $dados->getEstatistica()->getAvaliacoes(); ?> avaliações.</span>
                    </div>    
                </div>
            <?php } ?>
            <hr />
            <?php if($dados->getEstatistica()->getOrganizadasOnline() == 0) {?>
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Atleta ainda não foi avaliado por administradores de quadras</span>
                    </div>    
                </div>              
            <?php } else { ?>
                <div class="row">
                    <div class="cell-sm-12">
                        <span title="Avaliação feita pelos administradores de quadras" class="perfil-label">Avaliação como organizador: </span><span title="<?php echo ($dados->getEstatistica()->getOrganizador()/$dados->getEstatistica()->getOrganizadasOnline()); ?>"><input data-static="true" data-role="rating" data-value="<?php echo ($dados->getEstatistica()->getOrganizador()/$dados->getEstatistica()->getOrganizadasOnline()); ?>"></span>
                    </div>    
                </div>
                <div class="row">
                    <div class="cell-sm-12">
                        <span>Total de <?php echo $dados->getEstatistica()->getOrganizadasOnline(); ?> avaliações.</span>
                    </div>    
                </div>
            <?php } ?>
                <form id="form-adicionar-amigo">
                <br />
                <?php if($_SESSION['tipo'] == 'usuario') { ?>
                    <div class="row">
                        <div class="cell-sm-12">
                            <input type="button" class="button bg-lightBlue place-right" value="Adicionar aos amigos" id="btn-adicionar-amigo">
                            <input type="hidden" name="usuario" value="<?php echo $dados->getId(); ?>">
                        </div>
                    </div>
                <?php } ?>
                
                <br />&nbsp;
                </form>
            </div>
        </div>
    </body>
</html>