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
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo">aa</h3>

            <p class="resposta-mensagem">aa</p>
        </div>
        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div class="conteudo">
            <div class="contorno">
                <div class="accordion large-heading" data-role="accordion">
                    <div class="frame active">
                        <div class="heading">Partidas futuras <span class="mif-calendar icon"></span></div>
                        <div class="content">Frame content</div>
                    </div>
                    <div class="frame active">
                        <div class="heading">Solicitações de amizades pendentes <span class="mif-users icon"></span></div>
                        <div class="content" id="div-amigos-pendentes">
                            <form id="form-amizades-pendentes">
                                <table id="tabela-amigos-pendentes">
                                    <tbody>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="frame active ">
                        <div class="heading">Avaliações pendentes <span class="mif-pencil icon"></div>
                        <div class="content">Módulo ainda não desenvolvido.</div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>