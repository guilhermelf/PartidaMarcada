<?php
class RankingController extends Controller {
    function index_action() {
        if(empty($_SESSION['tipo']))
            $this->View('index');
        else {
            if (isset($_SESSION['tipo'])) {
                $this->View('ranking/index');
            } else {
                header("location: /partidamarcada/");
            }
        }
    }
    
    function medalhas() {
        if(empty($_SESSION['tipo']))
            $this->View('ranking/medalhas');
        else {
            if (isset($_SESSION['tipo'])) {
                $this->View('ranking/medalhas');
            } else {
                header("location: /partidamarcada/");
            }
        }
    }
}