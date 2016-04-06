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
    </head>
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo">aa</h3>

            <p class="resposta-mensagem">aa</p>
        </div>
        
        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div class="conteudo">

            <div class="form-cadastro grid">
                <form id="form-usuario-alteraremail">
                    <br />
                    <br />
                    <h4>Alterar e-mail</h4>
                    <hr />


                    <div class="row cells3">
                        <div class="cell">
                            <label>E-mail atual</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="email">
                            </div>
                        </div>
                        <div class="cell">
                            <label>Novo e-mail</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="novo_email">
                            </div>
                        </div>
        
                        <div class="cell">
                            <label>Confirmar novo e-mail</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="novo_email2">
                            </div>
                        </div>
                    </div>
                </form>
                <input type="button" class="full-size bg-lightBlue" value="Alterar" id="btn-usuario-alteraremail">
            </div>
        </div>
    </div>
</body>
</html>