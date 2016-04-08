<?php $quadra = $_SESSION['nome']; ?>
<script>
//logar usuário
    $('#login-usuario').on('click', '.btn-usuario-logar', function () {
        $.ajax({
            type: "post",
            dataType: 'json',
            url: "/partidamarcada/usuario/logar",
            data: $("#login-usuario").serialize(),
            success: function (resposta) {

                if (resposta.status) {
                    $(".resposta-titulo").html("Sucesso");
                    $(".resposta-mensagem").html(resposta.mensagem);
                    $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');

                    window.location.href = "/partidamarcada/usuario";
                } else {
                    $(".resposta-titulo").html("Erro");
                    $(".resposta-mensagem").html(resposta.mensagem);
                    $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                }

                $("#resposta").data('dialog').open();
            }
        });

        return false;
    });
    
    
</script>
<div class="app-bar" id="menu-usuario">
    <a class="app-bar-element">
        <span id="toggle-tiles-dropdown" class="mif-apps mif-2x"></span>
        <div class="app-bar-drop-container"
             data-role="dropdown"
             data-toggle-element="#toggle-tiles-dropdown"
             data-no-close="false" style="width: 324px;">
            <div class="tile-container bg-white">
                <div class="tile-small bg-cyan">
                    <div class="tile-content iconic">
                        <span class="icon mif-onedrive"></span>
                    </div>
                </div>
                <div class="tile-small bg-yellow">
                    <div class="tile-content iconic">
                        <span class="icon mif-google"></span>
                    </div>
                </div>
                <div class="tile-small bg-red">
                    <div class="tile-content iconic">
                        <span class="icon mif-facebook"></span>
                    </div>
                </div>
                <div class="tile-small bg-green">
                    <div class="tile-content iconic">
                        <span class="icon mif-twitter"></span>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <span class="app-bar-divider"></span>
    <ul class="app-bar-menu">
        <li><a href="/partidamarcada">Partida Marcada</a></li>
        <li><a href="">Quadras</a></li>
        <li><a href="">Sobre</a></li>
    </ul>

    <div class="app-bar-element place-right active-container">
        <span class="dropdown-toggle active-toggle"><span class="mif-cog"></span> Parque Esportivo <?php echo $quadra; ?></span>
        <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 220px; display: block;">
            <h2 class="text-light">Opções</h2>
            <ul class="unstyled-list fg-dark">
                <li><a href="" class="fg-white1 fg-hover-yellow">Perfil</a></li>
                <li><a href="/partidamarcada/parqueesportivo/alteraremail" class="fg-white2 fg-hover-yellow">Alterar e-mail</a></li>
                <li><a href="/partidamarcada/parqueesportivo/alterarsenha" class="fg-white2 fg-hover-yellow">Alterar senha</a></li>
                <li><a href="/partidamarcada/parqueesportivo/deslogar" class="fg-white3 fg-hover-yellow" id="btn-quadra-deslogar">Sair</a></li>
            </ul>
        </div>
    </div>
</div>
<script>
//deslogar parqueesportivo
    $("#btn-quadra-deslogar").on('click', function () {

        $.ajax({
            type: "get",
            url: "/partidamarcada/parqueesportivo/deslogar",
            success: function (resposta) {
                window.location.href = "/partidamarcada";
            }
        });

        return false;
    });
</script>