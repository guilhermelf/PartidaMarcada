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
        $(document).ready(function () {

            //logar quadra
            $('#btn-quadra-logar').on('click', function () {
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: "/partidamarcada/parqueEsportivo/logar",
                    data: $("#form-quadra-logar").serialize(),
                    success: function (resposta) {
                        console.log(resposta);

                        if (resposta.status) {
                            $(".resposta-titulo").html("Sucesso");
                            $(".resposta-mensagem").html(resposta.mensagem);
                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                            $("#resposta").data('dialog').open();
                            setTimeout(function() {
                                window.location.href = "/partidamarcada/parqueEsportivo";
                            }, 2000);                           
                        } else {
                            $(".resposta-titulo").html("Erro");
                            $(".resposta-mensagem").html(resposta.mensagem);
                            $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');

                            $("#resposta").data('dialog').open();
                        }
                    }
                });
                return false;
            });
        });
    </script>
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo"></h3>

            <p class="resposta-mensagem"></p>
        </div>       

        <?php include 'app/views/header/header.php'; ?>
        <div class="conteudo">

            <div class="form-cadastro grid">
                <form id="form-quadra-logar">
                    <h2>Acessar o módulo quadra</h2>
                    <hr />
                    <br />
                    <h4>Informações de login</h4>
                    <hr />
                    <div class="row cells2">
                        <div class="cell">
                            <label>E-mail</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="quadra-email">
                            </div>
                        </div>

                        <div class="row cells2">
                            <div class="cell">
                                <label>Senha</label>
                                <div class="input-control password full-size">                       
                                    <input type="password" name="quadra-senha">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                <input type="button" class="full-size bg-lightBlue" value="Entrar" id="btn-quadra-logar">
            </div>
        </div>
    </div>
</div>
</body>
</html>