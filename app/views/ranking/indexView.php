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
                   console.log(resposta);
                   $.each(resposta, function(k, v) {
                       if(v.avaliacoes == 0) {
                            $("#tabela-estatisticas-atletas").find('tbody').append("<tr>" +
                                "<td>" + v.nome + "</td>" +
                                "<td>" + v.participacoes + "</td>" +
                                "<td>" + v.partidasMarcadas + "</td>" +
                                "<td>" + 0 + "</td>" +
                                "<td>" + 0 + "</td>" +
                                "<td>" + 0 + "</td>" +
                                "<td>" + v.pontos + "</td>" +
                            "</tr>");
                       } else {
                            $("#tabela-estatisticas-atletas").find('tbody').append("<tr>" +
                                "<td>" + v.nome + "</td>" +
                                "<td>" + v.participacoes + "</td>" +
                                "<td>" + v.partidasMarcadas + "</td>" +
                                "<td>" + v.comportamento/v.avaliacoes + "</td>" +
                                "<td>" + v.habilidade/v.avaliacoes + "</td>" +
                                "<td>" + v.pontualidade/v.avaliacoes + "</td>" +
                                "<td>" + v.pontos + "</td>" +
                            "</tr>");
                        }
                   })
                   
                   $('#tabela-estatisticas-atletas').DataTable({
                        "order": [[ 6, "desc" ]]
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
            <div data-role="accordion" data-one-frame="true" data-show-active="true">                                    
                <div class="frame active">
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
                                <th>Pontos</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="frame">
                    <div class="heading accor"><span class="mif-chart-bars2 icon"></span> Ranking das quadras</div>
                    <div class="content">
                        
                    </div>
                </div>                   
            </div>
        </div>
    </body>
</html>
        