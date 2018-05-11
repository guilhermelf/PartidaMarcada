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

                //buscar partidas novas cadastradas pelo usuário
                $('.minhasPartidas').remove();
                $.ajax({
                    async: false,
                    type: "post",
                    url: "/partidamarcada/partida/listarMinhasNovasPartidas",
                    dataType: "json",
                    success: function (resposta) {
                        $.each(resposta, function (k, v) {
                            $("#minhas-partidas").find(".content").find(".p-2").append(
                                "<a class='minhas-partidas'>" + 
                                    v.data + ", das " + v.inicio + "h às " + v.final + "h na quadra " + v.quadra.numero + " da(o) " + v.quadra.parqueEsportivo.nome + 
                                "</a><br />"
                            );
                        });
                    }
                });

                $('#tabela-amigos-pendentes').hide();
                $('.amigos').remove();

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: "/partidamarcada/amigo/amizadesPendentes",
                    success: function (resposta) {
                        if(resposta) {
                        $.each(resposta, function (k, v) {

                            $('#tabela-amigos-pendentes').find('tbody').append(
                                    "<tr class='amigos'>" +
                                    "<td>" + v.usuario1.nome + " " + v.usuario1.sobrenome + " (" + v.usuario1.apelido + ")" + "</td>" +
                                    "<td width='50px;'>" +
                                    "<span style='cursor:pointer; float:left;' class='mif-checkmark fg-green btn-amizade-aceitar' title='Aceitar'></span>" +
                                    "<span style='cursor:pointer; float:right;' class='mif-cross fg-red btn-amizade-rejeitar' title='Rejeitar'></span>" +
                                    "<span class='id-amizade' style='display:none; cursor:pointer;'>" + v.id + "</span>" +
                                    "</td>" +
                                    "</tr>");

                        });
                        } else {
                            $('#tabela-amigos-pendentes').find('tbody').append(
                                    "<tr class='amigos'>" +
                                    "<td colspan='2'>Nenhuma solicitação de amizade.</td>" +
                                    "</tr>");
                        }

                        $('#tabela-amigos-pendentes').show();
                    }
                });
                
                //aceitar amizade
                $('#tabela-amigos-pendentes').on('click', '.btn-amizade-aceitar', function () {
                    var id = $(this).parent().find(".id-amizade").text();

                    $.ajax({
                        type: "post",
                        dataType: 'json',
                        data: {id: id},
                        url: "/partidamarcada/amigo/aceitarAmizade",
                        success: function (resposta) {
                            console.log(resposta);
                            if (resposta.status) {
                                $(".resposta-titulo").html("Sucesso");
                                $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                                $(".resposta-mensagem").html(resposta.mensagem);

                                $("#resposta").data('dialog').open();

                                setTimeout(function () {
                                    window.location.href = "/partidamarcada/usuario"
                                }, 2000);
                            } else {
                                $(".resposta-titulo").html("Erro");
                                $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                                $(".resposta-mensagem").html(resposta.mensagem);

                                $("#resposta").data('dialog').open();
                            }
                        }
                    });
                });
                
                //rejeitar amizade
                $('#tabela-amigos-pendentes').on('click', '.btn-amizade-rejeitar', function () {
                    var id = $(this).parent().find(".id-amizade").text();

                    $.ajax({
                        type: "post",
                        dataType: 'json',
                        data: {id: id},
                        url: "/partidamarcada/amigo/rejeitarAmizade",
                        success: function (resposta) {
                            console.log(resposta);
                            if (resposta.status) {
                                $(".resposta-titulo").html("Sucesso");
                                $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                                $(".resposta-mensagem").html(resposta.mensagem);

                                $("#resposta").data('dialog').open();

                                setTimeout(function () {
                                    window.location.href = "/partidamarcada/usuario"
                                }, 2000);
                            } else {
                                $(".resposta-titulo").html("Erro");
                                $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                                $(".resposta-mensagem").html(resposta.mensagem);

                                $("#resposta").data('dialog').open();
                            }
                        }
                    });
                });
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
            <div id="div-partidas" style="display: block;">
                <div data-role="accordion" data-one-frame="true" data-show-active="true" data-active-heading-class="bg-cyan fg-white">
                    <div class="frame active" id="minhas-partidas" class="bg-cyan fg-white">
                        <div class="heading accor"><span class="mif-calendar icon"></span> Próximas partidas</div>
                        <div class="content">
                            <div class="p-2"><span class="opcoes-partida"></span></div>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="heading bg-cyan fg-white accor"><span class="mif-users icon"></span> Solicitações de amizade pendentes</div>
                        <div class="content" id="div-amigos-pendentes">
                            <form id="form-amizades-pendentes">
                                <table id="tabela-amigos-pendentes">
                                    <tbody>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="frame active">
                        <div class="heading bg-cyan fg-white accor"><span class="mif-user-plus icon"></span> Avaliaçãos pendentes</div>
                        <div class="content">
                            <div class="content">Módulo ainda não desenvolvido.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>