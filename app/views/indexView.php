<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/build/css/metro.css" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-icons.css" rel="stylesheet" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-schemes.css" rel="stylesheet">
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-responsive.css" rel="stylesheet">
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js" charset="UTF-8"></script>
        <script src="/partidamarcada/components/metro-ui-css/build/js/metro.js"></script>
        <title>PartidaMarcada.com</title>
    </head>
    <body> 
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo"></h3>

            <p class="resposta-mensagem"></p>
        </div>
        <?php include 'app/views/header/header.php'; ?>

        <div class="conteudo">
            <div class="carousel" data-role="carousel" data-height="284" data-control-next="<span class='mif-chevron-right'></span>" data-control-prev="<span class='mif-chevron-left'></span>" style="width: 100%; height: 200px;">
                <div class="slide" style="display: block;"><div class="image-container image-format-fill" style="width: 100%; height: 100%;"><div class="frame"><div class="padding30" style="width: 100%; height: 100%; border-radius: 0px; background-image: url('http://localhost/partidamarcada/img/futebol.jpg'); background-size: cover; background-repeat: no-repeat;">
                                <h2>Partida Marcada</h2>
                                <p>
                                    Bem vindo ao Partida Marcada! Portal para organização de jogos.
                                </p></div></div>
                    </div></div>
                <div class="slide" style="display: block;"><div class="image-container image-format-fill" style="width: 100%; height: 100%;"><div class="frame"><div class="padding30" style="width: 100%; height: 100%; border-radius: 0px; background-image: url('http://localhost/partidamarcada/img/tenis.jpg'); background-size: cover; background-repeat: no-repeat;">
                                <h2>First slide</h2>
                                <p>
                                    Carousel :: Metro UI CSS - The front-end framework for developing projects on the web in Windows Metro Style
                                </p></div></div></div></div>
               <div class="slide" style="display: block;"><div class="image-container image-format-fill" style="width: 100%; height: 100%;"><div class="frame"><div class="padding30" style="width: 100%; height: 100%; border-radius: 0px; background-image: url('http://localhost/partidamarcada/img/basquete.jpg'); background-size: cover; background-repeat: no-repeat;">
                                <h2>First slide</h2>
                                <p>
                                    Carousel :: Metro UI CSS - The front-end framework for developing projects on the web in Windows Metro Style
                                </p></div></div></div></div>
                <div class="slide" style="display: block;"><div class="image-container image-format-fill" style="width: 100%; height: 100%;"><div class="frame"><div class="padding30" style="width: 100%; height: 100%; border-radius: 0px; background-image: url('http://localhost/partidamarcada/img/handebol.jpg'); background-size: cover; background-repeat: no-repeat;">
                                <h2>First slide</h2>
                                <p>
                                    Carousel :: Metro UI CSS - The front-end framework for developing projects on the web in Windows Metro Style
                                </p></div></div></div></div>
                <div class="carousel-bullets"><a class="carousel-bullet" href="javascript:void(0)" data-num="0"></a><a class="carousel-bullet" href="javascript:void(0)" data-num="1"></a><a class="carousel-bullet bullet-on" href="javascript:void(0)" data-num="2"></a><a class="carousel-bullet" href="javascript:void(0)" data-num="3"></a></div><span class="carousel-switch-next"><span class="mif-chevron-right"></span></span><span class="carousel-switch-prev"><span class="mif-chevron-left"></span></span></div>
            <br />
            <h1 class="align-center">Bem vindo ao partida marcada</h1>
            <p class="indent-paragraph">
                Numa época em que a falta de tempo impera na vida das pessoas, a prática de atividades físicas tornou-se uma das poucas opções para se manter a saúde física e mental. Dentre as várias opções disponíveis, a prática esportiva destaca-se pelo grande número de pessoas que buscam por ela e a socialização que ela promove entre seus praticantes. Surgiu então, a ideia do desenvolvimento de um portal que permita a seus usuários criar e gerenciar eventos de práticas esportivas. O projeto tem como principal objetivo oferecer, através de uma aplicação web, toda a estrutura necessária para que um usuário organize o evento, sem a necessidade de buscar informações em qualquer outro local. 
            </p>
        </div>
    </body>
</html>