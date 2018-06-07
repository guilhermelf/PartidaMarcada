<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/css/metro-all.css" />
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/js/metro.js"></script>
        <title>Partida Marcada</title>
    </head>
    <body> 
        <div data-role="dialog" data-close-button="false" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>    
        <?php include 'app/views/header/header.php'; ?>

        <div class="conteudo container">
            <h1 class="align-center">Partida Marcada</h1>
            <hr />
            <br />
            <br />
            <div class="row">
                <div class="cell-sm-12">
                    <p class="text-leader2"><strong>Partida Marcada</strong> é um portal que surgiu com o objetivo de facilitar a organização de atividades esportivas, 
                    reunindo em um só local as principais informações necessárias para tal. Criar partidas, convidar atletas, buscar quadras, buscar partidas para jogar, avaliar
                    os participantes, avaliar as quadras e até, em alguns casos, agendar horário com a quadra através do sistema, são as principais funcionalidades oferecidas.</p>
                </div>
            </div>
            <br />
            <hr />
            <div class="row">
                <div class="cell-sm-2">
                    <div class="img-container">
                        <img class='badge' src='/partidamarcada/img/sports.png' title='Atleta' width='200px'>
                    </div>
                </div>                
                <div class="cell-sm-10">
                    <p><strong>Atleta</strong><br />
                    No <strong>Partida Marcada</strong> o atleta pode adicionar amigos, organizar atividades esportivas, convidar participantes, buscar partidas 
                públicas criadas por outros atletas e candidatar-se a participar, avaliar os participantes e a quadra das partidas que jogou, visualizar os rankings dos jogadores e quadras melhores avaliados.</p>
                </div>
            </div>
            <hr />
            <br />
            <hr />
            <div class="row">                     
                <div class="cell-sm-10">
                    <p><strong>Parque Esportivo</strong><br />
                    Administrar um parque esportivo no <strong>Partida Marcada</strong> abre uma série de possibilidades ao responsável, como manter o cadastro das quadras do 
                    parque, disponibilizar informações de contato, localização e serviços extra disponíveis. Caso o administrador deseje utilizar o agendamento online é possível
                    aceitar as partidas organizadas no sistema, reservar horários, visualizar a agenda do dia em cada uma das quadras e avaliar os organizadores das partidas.</p>
                </div>   
                <div class="cell-sm-2">
                    <div class="img-container">
                        <img class='badge' src='/partidamarcada/img/quadras.png' title='Parque Esportivo' width='200px'>
                    </div>       
                </div>            
            </div>
            <hr />
            <br />
            <hr />
            <div class="row">
                <div class="cell-sm-2">
                    <div class="img-container">
                        <img class='badge' src='/partidamarcada/img/badges.png' title='Rankings e medalhas' width='200px'>
                    </div>
                </div>
                <div class="cell-sm-10">
                    <p><strong>Rankings e medalhas</strong><br />
                    O <strong>Partida Marcada</strong> conta com um sistema lúdico para avaliar e classificar os atletas e quadras. Pontuação, ranking e medalhas para os atletas que se destacam, 
                    além do ranking de quadras são ótimas ferramentas que auxiliam na hora de convidar participantes e procurar bons locais para a prática da atividade.</p>
                </div>
            </div>
            <hr />
        </div>
    </body>
</html>