<div class="app-bar-expand-md">

    <span class="app-bar-divider"></span>
    <ul class="h-menu">
        <li><a href="/partidamarcada">Partida Marcada</a></li>
        <li>
            <a href="" class="dropdown-toggle">Atleta</a>
            <ul class="d-menu" data-role="dropdown">
                <li id="usuario-mostrar"><a href="#">Entrar</a></li>
                <li><a href="/partidamarcada/usuario/cadastrar">Cadastrar</a></li>                             
            </ul>
        </li>
        <li>
            <a href="" class="dropdown-toggle">Quadra</a>
            <ul class="d-menu" data-role="dropdown">
                <li id="quadra-mostrar"><a href="#">Entrar</a></li>
                <li><a href="/partidamarcada/parqueesportivo/cadastrar">Cadastrar</a></li>         
            </ul>
        </li>
    </ul>

    <div id="div-usuario-logar" style="display: none">
        <form id="login-usuario" class="login-form bg-white p-6 mx-auto border bd-default win-shadow">
            <span class="mif-vpn-lock mif-4x place-right" style="margin-top: -10px;"></span>
            <h2 class="text-light">Entrar como atleta</h2>
            <hr class="thin mt-4 mb-4 bg-white">
            <div class="form-group">
                <input type="text" data-prepend="<span class='mif-envelop'>" placeholder="Digite seu e-mail..." data-validate="required email" class="usuario-email" name="usuario-email">
            </div>
            <div class="form-group">
                <input type="password" data-prepend="<span class='mif-key'>" placeholder="Digite sua senha..." data-validate="required minlength=6" class="usuario-senha" name="usuario-senha">
            </div>
            <div class="form-group mt-10">
                <button class="button cell-sm-12 bg-blue btn-usuario-logar" id="btn-usuario-logar">Entrar</button>
                <br />&nbsp;
                <button class="button cell-sm-12 bg-orange" id="cancelar-usuario-mostrar">Voltar</button>
            </div>
        </form>
    </div>

    <div id="div-quadra-logar" style="display: none">
        <form id="login-quadra" class="login-form bg-white p-6 mx-auto border bd-default win-shadow">
            <span class="mif-vpn-lock mif-4x place-right" style="margin-top: -10px;"></span>
            <h2 class="text-light">Entrar como administrador de quadra</h2>
            <hr class="thin mt-4 mb-4 bg-white">
            <div class="form-group">
                <input type="text" data-prepend="<span class='mif-envelop'>" placeholder="Digite seu e-mail..." data-validate="required email" class="quadra-email" name="quadra-email">
            </div>
            <div class="form-group">
                <input type="password" data-prepend="<span class='mif-key'>" placeholder="Digite sua senha..." data-validate="required minlength=6" class="quadra-senha" name="quadra-senha">
            </div>
            <div class="form-group mt-10">
                <button class="button cell-sm-12 bg-blue btn-quadra-logar" id="btn-quadra-logar">Entrar</button>
                <br />&nbsp;
                <button class="button cell-sm-12 bg-orange" id="cancelar-quadra-mostrar">Voltar</button>
            </div>
        </form>
    </div>

    <!-- <div class="app-bar-element place-right">
        <a class="dropdown-toggle fg-white"><span class="mif-enter"></span> Login de atleta</a>
        <div class="app-bar-drop-container bg-white fg-dark place-right"
             data-role="dropdown" data-no-close="true">
            <div class="padding20">
                <form id="login-usuario">
                    <h4 class="text-light">Login de atleta</h4>
                    <div class="input-control text">
                        <span class="mif-user prepend-icon"></span>
                        <input type="text" class="usuario-email" name="usuario-email">
                    </div>
                    <div class="input-control text">
                        <span class="mif-lock prepend-icon"></span>
                        <input type="password" class="usuario-senha" name="usuario-senha">
                    </div>

                    <div class="form-actions">
                        <button class="button btn-usuario-logar">Entrar</button>
                        <button class="button" id="btn-cancelar">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
</div>
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
                    setTimeout(function(){ 
                        window.location.href = "/partidamarcada/usuario"; }, 3000
                    );                
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

     //logar quadra
     $('#login-quadra').on('click', '.btn-quadra-logar', function () {
        $.ajax({
            type: "post",
            dataType: 'json',
            url: "/partidamarcada/parqueEsportivo/logar",
            data: $("#login-quadra").serialize(),          
            success: function (resposta) {
                if (resposta.status) {
                    $(".resposta-titulo").html("Sucesso");
                    $(".resposta-mensagem").html(resposta.mensagem);
                    $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                    setTimeout(function(){ 
                        window.location.href = "/partidamarcada/parqueesportivo"; }, 3000
                    );                
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