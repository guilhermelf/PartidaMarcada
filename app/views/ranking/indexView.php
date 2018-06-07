<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/css/metro-all.css" />
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/js/metro.js"></script>
        <link rel="stylesheet" type="text/css" href="/partidamarcada/components/jquery/datatable/datatables.min.css"/>
        <script type="text/javascript" src="/partidamarcada/components/jquery/datatable/datatables.min.js"></script>
        <title>Partida Marcada</title>
    </head>
    <script>
        $(document).ready(function () {   
            $.ajax({
                type: "post",
                url: "/partidamarcada/estatisticaAtleta/listar",
                dataType: "json",
                success: function (resposta) {
            
                   $.each(resposta, function(k, v) {
                       if(v.avaliacoes == 0) {
                            $("#tabela-estatisticas-atletas").find('tbody').append("<tr>" +
                                "<td><a target='_blank' href='/partidamarcada/usuario/perfil/" + v.idUsuario + "'>" + v.nome + "</a></td>" +
                                "<td>" + v.participacoes + "</td>" +
                                "<td>" + v.partidasMarcadas + "</td>" +
                                "<td></td>" +
                                "<td></td>" +
                                "<td></td>" +
                                "<td>" + v.avaliacoes + "</td>" +
                                "<td>" + v.pontos + "</td>" +
                            "</tr>");
                       } else {
                            $("#tabela-estatisticas-atletas").find('tbody').append("<tr>" +
                                "<td><a target='_blank' href='/partidamarcada/usuario/perfil/" + v.idUsuario + "'>" + v.nome + "</a></td>" +
                                "<td>" + v.participacoes + "</td>" +
                                "<td>" + v.partidasMarcadas + "</td>" +
                                "<td title='" + v.comportamento/v.avaliacoes + "'><span style='display: none;'>" + v.comportamento/v.avaliacoes + "</span>" + '<input data-static="true" data-role="rating" data-value="' + v.comportamento/v.avaliacoes + '"></td>' +
                                "<td title='" + v.habilidade/v.avaliacoes + "'><span style='display: none;'>" + v.habilidade/v.avaliacoes + "</span>" + '<input data-static="true" data-role="rating" data-value="' + v.habilidade/v.avaliacoes + '"></td>' +
                                "<td title='" + v.pontualidade/v.avaliacoes + "'><span style='display: none;'>" + v.pontualidade/v.avaliacoes + "</span>" + '<input data-static="true" data-role="rating" data-value="' + v.pontualidade/v.avaliacoes + '"></td>' +
                                "<td>" + v.avaliacoes + "</td>" +
                                "<td>" + v.pontos + "</td>" +
                            "</tr>");
                        }
                   })
                   
                   $('#tabela-estatisticas-atletas').DataTable({
                        "order": [[ 6, "desc" ]],
                        "paging":   false,
                        "info":     false,
                        "searching":   false
                    });
                }
            });

            $.ajax({
                type: "post",
                url: "/partidamarcada/estatisticaQuadra/listar",
                dataType: "json",
                success: function (resposta) {
 
                   $.each(resposta, function(k, v) {
                       if(v.avaliacoes == 0) {
                            $("#tabela-estatisticas-quadras").find('tbody').append("<tr>" +
                                "<td><a target='_blank' href='/partidamarcada/parqueesportivo/perfil/" + v.idParqueEsportivo + "'>" + v.nome + "</a></td>" +
                                "<td>" + v.partidas + "</td>" +
                                "<td></td>" +
                                "<td></td>" +
                                "<td></td>" +
                                "<td>" + v.avaliacoes + "</td>" +
                            "</tr>");
                       } else {
                            $("#tabela-estatisticas-quadras").find('tbody').append("<tr>" +
                                "<td><a target='_blank' href='/partidamarcada/parqueesportivo/perfil/" + v.idParqueEsportivo + "'>" + v.nome + "</a></td>" +
                                "<td>" + v.partidas + "</td>" +
                                "<td title='" + v.atendimento/v.avaliacoes + "'><span style='display: none;'>" + v.atendimento/v.avaliacoes + "</span>" + '<input data-static="true" data-role="rating" data-value="' + v.atendimento/v.avaliacoes + '"></td>' +
                                "<td title='" + v.estrutura/v.avaliacoes + "'><span style='display: none;'>" + v.estrutura/v.avaliacoes + "</span>" + '<input data-static="true" data-role="rating" data-value="' + v.estrutura/v.avaliacoes + '"></td>' +
                                "<td title='" + v.qualidade/v.avaliacoes + "'><span style='display: none;'>" + v.qualidade/v.avaliacoes + "</span>" + '<input data-static="true" data-role="rating" data-value="' + v.qualidade/v.avaliacoes + '"></td>' +
                                "<td>" + v.avaliacoes + "</td>" +
                            "</tr>");
                        }
                   })
                   
                   $('#tabela-estatisticas-quadras').DataTable({
                        "order": [[ 1, "desc" ]],
                        "paging":   false,
                        "info":     false,
                        "searching":   false
                    });
                }
            });

        });
    </script>
    <body>            
        <?php if($_SESSION['tipo'] == 'usuario') {
            include 'app/views/header/headerUsuario.php';
         } else {
            include 'app/views/header/headerQuadra.php';
         } ?>
        <div data-role="dialog" data-close-button="false" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <p class="text-leader2 align-center">Clique nos listas para ver os melhores classificados</p>
            <hr />
            <br />
            <div data-role="accordion" data-one-frame="false" data-show-active="false">                                    
                <div class="frame">
                    <div class="heading accor"><span class="mif-chart-bars2 icon"></span> Ranking dos atletas</div>
                    <div class="content">
                        <table id='tabela-estatisticas-atletas' class="table striped hovered">
                            <thead>
                                <th>Nome</th>
                                <th>Partidas</th>
                                <th>Partidas Organizadas</th>
                                <th>Comportamento</th>
                                <th>Habilidade</th>
                                <th>Pontualidade</th>
                                <th title="Avaliações recebidas de outros atletas">Avaliações</th>
                                <th>Pontos</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <p class="text-secondary"><strong>Critérios de pontuação</strong><br />
                        • 100 pontos ao se cadastrar no sistema<br />
                        • 50 pontos por partida marcada<br />
                        • 10 pontos por partida jogada 
                    </p>
                    </div>
                </div>
                <div class="frame">
                    <div class="heading accor"><span class="mif-chart-bars2 icon"></span> Ranking das quadras</div>
                    <div class="content">
                    <table id='tabela-estatisticas-quadras' class="table striped hovered">
                            <thead>
                                <th>Nome</th>
                                <th>Partidas</th>
                                <th>Atendimento</th>
                                <th>Estrutura</th>
                                <th>Qualidade</th>
                                <th title="Avaliações recebidas">Avaliações</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>                   
            </div>
        </div>
    </body>
</html>