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
    </head>
    <script>
        $(document).ready(function () {
            
            $('#btn-partida-avaliar').on('click', function() {


                Metro.dialog.create({
                    title: "Avaliar partida",
                    content: "<div>Você tem certeza que deseja avaliar a partida?<br />Não será possível alterar a avaliação posteriormente!</div>",
                    actions: [
                        {
                            caption: "Tenho certeza",
                            cls: "js-dialog-close alert",
                            onclick: function(){
                                //console.log($('#form-usuario-alteraremail').serialize());
                                $.ajax({
                                    type: "post",
                                    dataType: 'json',
                                    data: $('#form-partida-avaliar').serialize(),
                                    url: "/partidamarcada/partida/salvarAvaliacao",
                                    success: function (resposta) {
                                        if(resposta) {
                                            $(".resposta-titulo").html("Sucesso");
                                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');     
                                            $(".resposta-mensagem").html("Avaliação salva com sucesso!");                              
                                        } else {
                                            $(".resposta-titulo").html("Erro");
                                            $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');    
                                            $(".resposta-mensagem").html("Erro ao salvar avaliação!");                
                                        }                                                                     
                                            $("#resposta").data('dialog').open();
                                            setTimeout(function () {    
                                                window.location.href = "/partidamarcada/partida/gerenciar/"
                                            }, 3000);                               
                                    }
                                });
                                return false;
                            }
                        },
                        {
                            caption: "Não, quero conferir os dados.",
                            cls: "js-dialog-close",
                            onclick: function(){
                                return false;
                            }
                        }
                    ]
                });
            });
        });
    </script>
    <body>
        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <form id="form-partida-avaliar">
                <h2 class="text-center">Avaliar partida</h2>
                <hr />            
                <br />
                <table class="table striped">
                    <thead>
                        <tr>
                            <th>Quadra</th>
                            <th>Qualidade (piso/gramado)</th>
                            <th>Estrutura da quadra (vestiários/bar)</th>
                            <th>Atendimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $dados->getQuadra()->getParqueEsportivo()->getNome(); ?></td>
                            <td><input data-role="rating" data-value="3"
                                    name="qualidade">
                            </td>
                            <td><input data-role="rating" data-value="3"
                                    name="estrutura">
                            </td>
                            <td><input data-role="rating" data-value="3"
                                    name="atendimento">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table striped" id="tabela-avaliar-atletas">
                    <thead>
                        <tr>
                            <th style="display: none">Id</th>
                            <th>Atleta</th>
                            <th>Habilidade</th>
                            <th>Comportamento</th>
                            <th>Pontualidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($dados->getParticipantes() as $participante) {
                                if($participante->getStatus() == 1 && $participante->getUsuario()->getId() != $_SESSION['id']) {
                                    echo '<tr class="avaliar-atletas">
                                        <td style="display: none"><input type="hidden" name="idAvaliado[]" value="' . $participante->getUsuario()->getId() . '"></td>
                                        <td>' . $participante->getUsuario()->getNome() . ' ' . $participante->getUsuario()->getSobrenome() . ' (' . $participante->getUsuario()->getApelido() .')</td>
                                        <td><input data-role="rating" data-value="3"
                                            name="habilidade[]">
                                        </td>
                                        <td><input data-role="rating" data-value="3"
                                            name="comportamento[]">
                                        </td>
                                        <td><input data-role="rating" data-value="3"
                                            name="pontualidade[]">
                                        </td>
                                    </tr>';
                                    }
                            }                            
                        ?>              
                    </tbody>
                </table>           
                <br />
                <input type="hidden" name="quadra" value="<?php echo $dados->getQuadra()->getId(); ?>">
                <input type="hidden" name="avaliador" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" name="partida" value="<?php echo $dados->getId(); ?>">
                <input type="button" class="cell-sm-12 button bg-lightBlue" value="Enviar avaliação" id="btn-partida-avaliar">
                <br />&nbsp;
            </form>           
        </div>
    </body>
</html>