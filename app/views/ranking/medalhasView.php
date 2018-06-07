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
            <h4 class="align-center">Informações sobre as medalhas</h4>
            <hr />
            <br />
            <div class="row">
                <div class="cell-sm-12">
                    <p class="text-leader2">As medalhas são exibidas no perfil dos atletas e visam destacar, não só os que mais utilizam o sistema para agendar/participar de atividades 
                    mas também os que são melhores avaliados por atletas e administradores de quadras.</p>
                    <p class="text-leader2">Os critérios para receber medalhas estão descritos abaixo:</p>
                </div>
            </div>
            <br />
            <hr />
            <div class="row">
                <div class="cell-sm-1">
                    <img class='badge' src='/partidamarcada/img/badges/fan.png' title='Organizador de elite' width='50px'>
                </div>
                <div class="cell-sm-11">
                    <p><strong>Organizador de elite</strong><br />
                    Medalha conferida aos atletas que receberam avaliação média maior ou igual a 4 dos administradores de quadras</p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="cell-sm-1">
                <img class='badge' src='/partidamarcada/img/badges/schedule.png' title='Mais de 100 partidas marcadas' width='50px'>
                </div>
                <div class="cell-sm-11">
                    <p><strong>Mais de 100 partidas marcadas</strong><br />
                    Medalha conferida aos atletas que marcaram mais de 100 partidas utilizando o sistema</p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="cell-sm-1">
                <img class='badge' src='/partidamarcada/img/badges/tickets.png' title='Mais de 10 partidas marcadas' width='50px'>
                </div>
                <div class="cell-sm-11">
                    <p><strong>Mais de 10 partidas marcadas</strong><br />
                    Medalha conferida aos atletas que marcaram mais de 10 partidas utilizando o sistema</p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="cell-sm-1">
                <img class='badge' src='/partidamarcada/img/badges/medal.png' title='Mais de 100 partidas jogadas' width='50px'>
                </div>
                <div class="cell-sm-11">
                    <p><strong>Mais de 100 partidas jogadas</strong><br />
                    Medalha conferida aos atletas que participaram de mais de 100 partidas</p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="cell-sm-1">
                <img class='badge' src='/partidamarcada/img/badges/medal-1.png' title='Mais de 50 partidas jogadas' width='50px'>
                </div>
                <div class="cell-sm-11">
                    <p><strong>Mais de 50 partidas jogadas</strong><br />
                    Medalha conferida aos atletas que participaram de mais de 50 partidas</p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="cell-sm-1">
                <img class='badge' src='/partidamarcada/img/badges/medal-2.png' title='Mais de 10 partidas jogadas' width='50px'>
                </div>
                <div class="cell-sm-11">
                    <p><strong>Mais de 10 partidas jogadas</strong><br />
                    Medalha conferida aos atletas que participaram de mais de 10 partidas</p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="cell-sm-1">
                <img class='badge' src='/partidamarcada/img/badges/head-hitting.png' title='Joga muito' width='50px'>
                </div>
                <div class="cell-sm-11">
                    <p><strong>Joga muito</strong><br />
                    Medalha conferida aos atletas que receberam avaliação média maior ou igual a 4 no quesito habilidade</p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="cell-sm-1">
                <img class='badge' src='/partidamarcada/img/badges/like.png' title='Comportamento exemplar' width='50px'>
                </div>
                <div class="cell-sm-11">
                    <p><strong>Comportamento exemplar</strong><br />
                    Medalha conferida aos atletas que receberam avaliação média maior ou igual a 4 no quesito comportamento</p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="cell-sm-1">
                <img class='badge' src='/partidamarcada/img/badges/clock.png' title='Pontual' width='50px'>
                </div>
                <div class="cell-sm-11">
                    <p><strong>Pontual</strong><br />
                    Medalha conferida aos atletas que receberam avaliação média maior ou igual a 4 no quesito pontualidade</p>
                </div>
            </div>
            <hr />
        </div>
    </body>
</html>