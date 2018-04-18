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
            //atualizar senha de parque esportivo
            $("#btn-quadra-alterarsenha").on('click', function () {

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    data: $("#form-quadra-alterarsenha").serialize(),
                    url: "/partidamarcada/parqueesportivo/atualizarSenha",
                    success: function (resposta) {
                        if (resposta.status) {
                            $(".resposta-titulo").html("Sucesso");
                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                            setTimeout(function () {
                                window.location.href = "/partidamarcada/parqueesportivo";
                            }, 2000);
                        } else {
                            $(".resposta-titulo").html("Erro");
                            $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                        }
                        $(".resposta-mensagem").html(resposta.mensagem);


                        $("#resposta").data('dialog').open();
                        console.log(resposta);
                    }
                });

                return false;
            });
        });
    </script>
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo">aa</h3>

            <p class="resposta-mensagem">aa</p>
        </div>

        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div class="conteudo">

            <div class="form-cadastro grid">
                <form id="form-quadra-alterarsenha">
                    <br />
                    <br />
                    <h4>Alterar senha</h4>
                    <hr />


                    <div class="row cells3">
                        <div class="cell">
                            <label>Senha atual</label>
                            <div class="input-control password full-size">                       
                                <input type="password" name="senha">
                            </div>
                        </div>
                        <div class="cell">
                            <label>Nova senha</label>
                            <div class="input-control password full-size">                       
                                <input type="password" name="nova_senha">
                            </div>
                        </div>
                        <!-- input[type=password] -->
                        <div class="cell">
                            <label>Confirmar nova senha</label>
                            <div class="input-control password full-size">                       
                                <input type="password" name="nova_senha2">
                            </div>
                        </div>
                    </div>
                </form>
                <input type="button" class="full-size bg-lightBlue" value="Alterar" id="btn-quadra-alterarsenha">
            </div>
        </div>
    </div>
</body>
</html>