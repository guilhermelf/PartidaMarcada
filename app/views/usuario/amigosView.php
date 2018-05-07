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
                $('#tabela-amigos-pendentes').hide();
                $('#tabela-amigos').hide();
                $('#div-amigos-busca').hide();
                $('.amigos').remove();
                $('.amigos-pendentes').remove();

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: "/partidamarcada/amigo/buscarAmigos",
                    success: function (resposta) {
                        if (resposta) {
                            $.each(resposta, function (k, v) {
                                if ($('#var-id-usuario').text() == v.usuario1id) {
                                    $('#tabela-amigos').find('tbody').append(
                                            "<tr class='amigos'>" +
                                                "<td><a href='/partidamarcada/usuario/perfil/" + v.usuario2id + "'>" + v.usuario2nome + "</a>" + "</td>" +
                                                "<td width='50px;'>" +
                                                    "<span style='cursor:pointer; float:right;' class='mif-cross fg-red btn-amizade-excluir' title='Excluir'></span>" +
                                                    "<span class='id-excluir-amizade' style='display:none; cursor:pointer;'>" + v.id + "</span>" +
                                                "</td>" +
                                            "</tr>");
                                } else if ($('#var-id-usuario').text() == v.usuario2id) {
                                    $('#tabela-amigos').find('tbody').append(
                                            "<tr class='amigos'>" +
                                                "<td><a href='/partidamarcada/usuario/perfil/" + v.usuario1id + "'>" + v.usuario1nome + "</a>" + "</td>" +
                                                "<td width='50px;'>" +
                                                    "<span style='cursor:pointer; float:right;' class='mif-cross fg-red btn-amizade-excluir' title='Excluir'></span>" +
                                                    "<span class='id-excluir-amizade' style='display:none; cursor:pointer;'>" + v.id + "</span>" +
                                                "</td>" +
                                            "</tr>");
                                }
                            });
                        } else {
                            $('#tabela-amigos').find('tbody').append(
                                    "<tr class='amigos'>" +
                                        "<td colspan='2'>Nenhum amigo adicionado.</td>" +
                                    "</tr>");
                        }

                        $('#tabela-amigos').show();
                    }
                });

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: "/partidamarcada/amigo/amizadesPendentes",
                    success: function (resposta) {
                        if (resposta) {
                            $.each(resposta, function (k, v) {
                                $('#tabela-amigos-pendentes').find('tbody').append(
                                        "<tr class='amigos-pendentes'>" +
                                        "<td><a href='/partidamarcada/usuario/perfil/" + v.usuario1.id + "'>" + v.usuario1.nome + " " + v.usuario1.sobrenome + " (" + v.usuario1.apelido + ")</a>" + "</td>" +
                                        "<td width='50px;'>" +
                                        "<span style='cursor:pointer; float:left;' class='mif-checkmark fg-green btn-amizade-aceitar' title='Aceitar'></span>" +
                                        "<span style='cursor:pointer; float:right;' class='mif-cross fg-red btn-amizade-rejeitar' title='Rejeitar'></span>" +
                                        "<span class='id-amizade' style='display:none; cursor:pointer;'>" + v.id + "</span>" +
                                        "</td>" +
                                        "</tr>");
                            });
                        } else {
                            $('#tabela-amigos-pendentes').find('tbody').append(
                                    "<tr class='amigos-pendentes'>" +
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
                                    window.location.href = "/partidamarcada/usuario/amigos"
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
                                    window.location.href = "/partidamarcada/usuario/amigos"
                                }, 3000);
                            } else {
                                $(".resposta-titulo").html("Erro");
                                $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                                $(".resposta-mensagem").html(resposta.mensagem);

                                $("#resposta").data('dialog').open();
                            }
                        }
                    });
                });

                //excluir amizade
                $('#tabela-amigos').on('click', '.btn-amizade-excluir', function () {
                    var id = $(this).parent().find(".id-excluir-amizade").text();

                    Metro.dialog.create({
                        title: "Excluir amigo",
                        content: "<div>Você tem certeza que deseja excluir essa amizade?</div>",
                        actions: [
                        {
                            caption: "Tenho certeza",
                            cls: "js-dialog-close alert",
                            onclick: function(){
                                $.ajax({
                                    type: "post",
                                    dataType: 'json',
                                    data: {id: id},
                                    url: "/partidamarcada/amigo/desfazerAmizade",
                                    success: function (resposta) {
                                        console.log(resposta);
                                        if (resposta.status) {
                                            $(".resposta-titulo").html("Sucesso");
                                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                                            $(".resposta-mensagem").html(resposta.mensagem);

                                            $("#resposta").data('dialog').open();

                                            setTimeout(function () {
                                                window.location.href = "/partidamarcada/usuario/amigos"
                                            }, 3000);
                                        } else {
                                            $(".resposta-titulo").html("Erro");
                                            $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                                            $(".resposta-mensagem").html(resposta.mensagem);

                                            $("#resposta").data('dialog').open();
                                        }
                                    }
                                });
                            }
                        },
                        {
                            caption: "Não quero excluir",
                            cls: "js-dialog-close",
                            onclick: function(){
                                return false;
                            }
                        }
                    ]
                });
            });

                //buscar amigo
                $('#btn-usuario-buscar').on('click', function () {
                    $('.busca').remove();
                    $('#div-amigos-busca').show();

                    $.ajax({
                        type: "post",
                        dataType: 'json',
                        data: $("#form-amizades-adicionar").serialize(),
                        url: "/partidamarcada/usuario/pesquisar",
                        success: function (resposta) {
                            console.log(resposta);
                            $.each(resposta, function (k, v) {
                                $('#tabela-amigos-busca').find('tbody').append(
                                        "<tr class='busca'>" +
                                        "<td><a href='/partidamarcada/usuario/perfil/" + v.id + "'>" + v.nome + "</a>" +
                                        "</td>" +
                                        "</tr>"
                                        );
                            });
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
                    <div class="frame active" id="div-amigos" class="bg-cyan fg-white">
                        <div class="heading accor text-right" id="div-amigos">Meus amigos <span class="mif-users icon"></span></div>
                        <div class="content">
                            <form id="form-amizades">
                                <table id="tabela-amigos">
                                    <tbody>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="heading bg-cyan fg-white accor text-right">Solicitações de amizade pendentes <span class="mif-users icon"></span></div>
                        <div class="content">
                            <form id="form-amizades-pendentes">
                                <table id="tabela-amigos-pendentes">
                                    <tbody>

                                    </tbody>
                                </table>
                            </form> 
                        </div>
                    </div>
                    <div class="frame active">
                        <div class="heading bg-cyan fg-white accor text-right">Buscar amigo <span class="mif-user-plus icon"></span></div>
                            <div class="content">
                                <form id="form-amizades-adicionar">
                                    <br />
                                    <div class="row">
                                        <div class="cell-sm-4">                 
                                            <input type="text" name="nome" placeholder="Nome">
                                        </div>
                                        <div class="cell-sm-4">                 
                                            <input type="text" name="sobrenome" placeholder="Sobrenome">
                                        </div>
                                        <div class="cell-sm-4">                 
                                            <input type="text" name="apelido" placeholder="Apelido">
                                        </div>
                                    </div>
                                    <br />
                                    <input type="button" class="cell-sm-12 button bg-lightBlue" value="Buscar" id="btn-usuario-buscar">
                                    <br />
                                    <div id="div-amigos-busca">
                                        <table id="tabela-amigos-busca">
                                            <thead>
                                                <th>Atletas localizados</th>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>