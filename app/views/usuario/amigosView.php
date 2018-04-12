<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/css/metro.css" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-icons.css" rel="stylesheet" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-schemes.css" rel="stylesheet">
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-responsive.css" rel="stylesheet">
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/js/metro.js"></script>
        <title>PartidaMarcada.com</title>
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
                                if ($('#var-id-usuario').text() == v.usuario1.id) {
                                    $('#tabela-amigos').find('tbody').append(
                                            "<tr class='amigos'>" +
                                            "<td><a href='/partidamarcada/usuario/perfil/" + v.usuario2.id + "'>" + v.usuario2.nome + " " + v.usuario2.sobrenome + " (" + v.usuario2.apelido + ")</a>" + "</td>" +
                                            "<td width='50px;'>" +
                                            "<span style='cursor:pointer; float:right;' class='mif-cross fg-red btn-amizade-excluir' title='Excluir'></span>" +
                                            "<span class='id-excluir-amizade' style='display:none; cursor:pointer;'>" + v.id + "</span>" +
                                            "</td>" +
                                            "</tr>");
                                } else if ($('#var-id-usuario').text() == v.usuario2.id) {
                                    $('#tabela-amigos').find('tbody').append(
                                            "<tr class='amigos'>" +
                                            "<td><a href='/partidamarcada/usuario/perfil/" + v.usuario1.id + "'>" + v.usuario1.nome + " " + v.usuario1.sobrenome + " (" + v.usuario1.apelido + ")</a>" + "</td>" +
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

                //excluir amizade
                $('#tabela-amigos').on('click', '.btn-amizade-excluir', function () {
                    var id = $(this).parent().find(".id-excluir-amizade").text();

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
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo">aa</h3>

            <p class="resposta-mensagem">aa</p>
        </div>
        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div class="conteudo">
            <div class="contorno">
                <div class="accordion large-heading" data-role="accordion">
                    <div class="frame active">
                        <div class="heading" id="div-amigos">Lista de amigos <span class="mif-users icon"></span></div>
                        <div class="content" id="div-amigos">
                            <form id="form-amizades">
                                <table id="tabela-amigos">
                                    <tbody>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="frame active">
                        <div class="heading">Solicitações de amizades pendentes <span class="mif-user-check icon"></span></div>
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
                        <div class="heading" id="div-amigos-adicionar">Adicionar amigo <span class="mif-user-plus icon"></div>
                        <div class="content grid" id="div-amigos-adicionar">
                            <form id="form-amizades-adicionar">
                                <div class="row cells3">
                                    <div class="cell">
                                        <label>Nome</label>
                                        <div class="input-control text full-size">                       
                                            <input type="text" name="nome">
                                        </div>
                                    </div>
                                    <div class="cell">
                                        <label>Sobrenome</label>
                                        <div class="input-control cell text full-size">                      
                                            <input type="text" name="sobrenome">
                                        </div>
                                    </div>
                                    <div class="cell">
                                        <label>Apelido</label>
                                        <div class="input-control cell text full-size">                      
                                            <input type="text" name="apelido">
                                        </div>
                                    </div>
                                    <input type="button" class="full-size bg-lightBlue" value="Buscar" id="btn-usuario-buscar">
                                    <div class="content" id="div-amigos-busca">
                                        <hr />
                                        <table id="tabela-amigos-busca">
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