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
    $(document).ready(function() {
        $('.agendamentosPendentes').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/agendamento/buscarAgendamentosPendentes",
                dataType: "json",
                success: function (resposta) {
                    if(resposta) {
                        $.each(resposta, function (k, v) {
                            $("#agendamentos-pendentes").find(".content").find(".p-2").append("<a target='_blank' class='agendamentosPendentes' href='/partidamarcada/partida/partida/" + v.partida.id + "'><span style='display:none;' class=id-agendamento>" + v.id + "</span>" + v.partida.data + ", das " + v.partida.inicio + "h às " + (v.partida.inicio + 1) + "h, partida de " + v.partida.esporte.nome + ", na quadra " + v.partida.quadra.numero + ", organizada por " + v.partida.usuario.nome + "</a>" +
                                "<span class='opcoes-partida'>" +
                                    "<a target='_blank' href='/partidamarcada/usuario/perfil/" + v.partida.usuario.id + "'>" +
                                        "<span class='partida-editar mif-user fg-green' title='Ver perfil do organizador'></span>" + 
                                    "</a>" +
                                    "&nbsp;&nbsp;&nbsp;" +
                                    "<span class='agendamento-cancelar mif-thumbs-up fg-green' title='Confirmar agendamento'>" + 
                                        "<span style='display:none;' class='id-cancelar'>" + v.id + "</span>" + 
                                    "</span>" +
                                    "&nbsp;&nbsp;&nbsp;" +
                                    "<span class='agendamento-cancelar mif-cross fg-red' title='Negar agendamento'>" + 
                                        "<span style='display:none;' class='id-cancelar'>" + v.id + "</span>" + 
                                    "</span>" +
                                "</span><br />"                           
                            );
                        });
                    }
                }
            });
       

            //buscar agendamento para cancelar pelo id
            $(".agendamento-cancelar").on('click', function(){
                var agendamento = $(this).find('.id-cancelar').text();
                Metro.dialog.create({
                    title: "Negar agendamento",
                    content: "<div>Você tem certeza que deseja negar o agendamento de horário?<br />Não será possível desfazer essa ação!</div>",
                    actions: [
                        {
                            caption: "Tenho certeza",
                            cls: "js-dialog-close alert",
                            onclick: function(){
                                $.ajax({
                                    async: false,
                                    type: "post",
                                    url: "/partidamarcada/agendamento/negar/" + agendamento,
                                    dataType: 'json',
                                    success: function (resposta) {
                                        if (resposta.status) {
                                            $(".resposta-titulo").html("Sucesso");
                                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');                                  
                                        } else {
                                            $(".resposta-titulo").html("Erro");
                                            $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');                   
                                        }      
                                        
                                        $(".resposta-mensagem").html(resposta.mensagem); 
                                        $("#resposta").data('dialog').open();
                                        
                                        setTimeout(function () {    
                                            window.location.href = "/partidamarcada/parqueesportivo"
                                        }, 3000);
                                    }
                                });
                            }
                        },
                        {
                            caption: "Não",
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
        <?php include 'app/views/header/headerQuadra.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <div id="div-partidas" style="display: block;">
                <div data-role="accordion" data-one-frame="true" data-show-active="true" data-active-heading-class="bg-cyan fg-white">
                    <div class="frame active" id="agendamentos-pendentes" class="bg-cyan fg-white">
                        <div class="heading accor"><span class="mif-calendar icon"></span> Agendamentos pendentes</div>
                        <div class="content">
                            <div class="p-2"><span class="opcoes-agendamento"></span></div>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="heading bg-cyan fg-white accor"><span class="mif-users icon"></span> Próximas partidas</div>
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
                        <div class="heading bg-cyan fg-white accor"><span class="mif-user-plus icon"></span> Reservar horário</div>
                        <div class="content">
                            <div class="content">Módulo ainda não desenvolvido.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>