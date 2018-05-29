<?php $quadra = $_SESSION['nome']; ?>
<script>
    $(document).ready(function () {
        $.ajax({
            async: false,
            type: "post",
            url: "/partidamarcada/parqueEsportivo/isOnline",
            success: function (resposta) {
                if(resposta == 1) {
                    $('#online').show();
                }
            }
        });
    });
</script>

<div class="app-bar" id="menu-quadra">
    <span class="app-bar-divider"></span>
    <!--<ul class="app-bar-menu">
        <li>
            <a href="" class="dropdown-toggle"><span class="mif-apps mif-2x"></span> Menu</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="/partidamarcada/usuario/amigos">Amigos</a></li>
                
                <li><a href="/partidamarcada/partida/gerenciar/">Partidas</a></li>
            </ul>
        </li>
    </ul>
    -->
    <span class="app-bar-divider"></span>
    <ul class="h-menu">
        <li><a href="/partidamarcada">Partida Marcada</a></li>
        <li id="online" style="display: none;"><a href="/partidamarcada">Partidas</a></li>
        <li><a href="/partidamarcada/parqueesportivo/quadras">Gerenciar quadras</a></li>
        <li><a href="/partidamarcada/ranking">Rankings</a></li>
        <li><a href="#" class="dropdown-toggle"><?php echo $quadra; ?></a>              
            <ul class="d-menu" data-role="dropdown">
                <li><a href="/partidamarcada/parqueesportivo/perfil/<?php echo $_SESSION['id']; ?>" class="fg-white1 fg-hover-yellow"><span style="display:none;" id="var-id-usuario"><?php echo $_SESSION['id']; ?></span>Meu perfil</a></li>
                <li><a href="/partidamarcada/parqueesportivo/atualizarperfil" class="fg-white2 fg-hover-yellow">Atualizar perfil</a></li>
                <li><a href="/partidamarcada/parqueesportivo/alteraremail" class="fg-white2 fg-hover-yellow">Alterar e-mail</a></li>
                <li><a href="/partidamarcada/parqueesportivo/alterarsenha" class="fg-white2 fg-hover-yellow">Alterar senha</a></li>
                <li class="divider"></li>
                <li><a href="" class="fg-white3 fg-hover-yellow" id="btn-quadra-deslogar">Sair</a></li>
            </ul>
        </li>
    </ul>  
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