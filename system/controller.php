<?php
class Controller {

    protected function View($layout = null, $dados = null) {
        if (empty($layout)) {
            require_once(PUBLIC_HTML . '404.html');
        } else {
            if (file_exists(VIEWS . $layout . 'View.php')) {
                require_once(VIEWS . $layout . 'View.php');
            } else
                require_once(PUBLIC_HTML . '404.html');
        }
    }
    
    protected function AccessDenied() {
        require_once(PUBLIC_HTML . '403.html');
    }
}