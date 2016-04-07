<div class="app-bar">

    <span class="app-bar-divider"></span>
    <ul class="app-bar-menu">
        <li>
            <a href="" class="dropdown-toggle"><span class="mif-apps mif-2x"></span> Menu</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="/partidamarcada/usuario/cadastrar">Cadastrar usuário</a></li>
            </ul>
        </li>

        <li><a href="/partidamarcada">Partida Marcada</a></li>
        <li>
            <a class="dropdown-toggle" href="/partidamarcada/parqueesportivo">Quadras</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="/partidamarcada/parqueesportivo/cadastrar">Entrar no sistema</a></li>
                <li><a href="/partidamarcada/parqueesportivo/logar">Cadastrar</a></li>
            </ul>
        </li>
        <li><a href="">Sobre</a></li>
    </ul>

    <div class="app-bar-element place-right">
        <a class="dropdown-toggle fg-white"><span class="mif-enter"></span> Entrar no sistema</a>
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
    </div>
</div>