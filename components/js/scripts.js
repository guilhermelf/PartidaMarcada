/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
      
    $('#login-usuario').on('click', '.btn-usuario-logar', function () {

        $.ajax({
            type: "post",
            url: "/partidamarcada/usuario/logar",
            data: $("#login-usuario").serialize(),
            success: function (resposta) {
                alert(resposta);
                window.location.href = "/partidamarcada/usuario";
            }
        });

        return false;
    });
    
    $("#btn-usuario-deslogar").on('click', function () {
        
        $.ajax({
            type: "get",
            url: "/partidamarcada/usuario/deslogar",
            success: function (resposta) {
                window.location.href = "/partidamarcada";
            }
        });
    })   
});

