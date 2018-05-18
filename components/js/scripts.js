/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    //botao de mostrar login usuario
    $('#usuario-mostrar').on('click', function() {
        $('#div-usuario-logar').show();
        $('.conteudo').css('opacity', '0.3');
    });
    $('#cancelar-usuario-mostrar').on('click', function() {
        $('#div-usuario-logar').hide();
        $('.conteudo').css('opacity', '1');
        return false;
    });

    //botao de mostrar login quadra
    $('#quadra-mostrar').on('click', function() {
        $('#div-quadra-logar').show();
        $('.conteudo').css('opacity', '0.3');
    });
    $('#cancelar-quadra-mostrar').on('click', function() {
        $('#div-quadra-logar').hide();
        $('.conteudo').css('opacity', '1');
        return false;
    });

    //botao cancelar
    $('#btn-cancelar').on('click', function () {
        $(".app-bar-drop-container").hide();

        return false;
    });

    //cadastrar usuário
    $("#btn-usuario-cadastrar").on('click', function () {

        $.ajax({
            type: "post",
            dataType: 'json',
            data: $("#form-usuario-cadastrar").serialize(),
            url: "/partidamarcada/usuario/salvar",
            success: function (resposta) {
                $(".resposta-mensagem").html(resposta.mensagem);
                if (resposta.status) {
                    $(".resposta-titulo").html("Sucesso");
                    $("#resposta").data('dialog').open();
                    setTimeout(function () {
                        window.location.href = "/partidamarcada"
                    }, 2000);
                    $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                } else {
                    $(".resposta-titulo").html("Erro");
                    $(".resposta-mensagem").html(resposta.mensagem);
                    $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                    $("#resposta").data('dialog').open();
                }
                

                console.log(resposta);
                return false;
            }
        });
    });

    //cadastrar parque esportivo
    $("#btn-quadra-cadastrar").on('click', function () {

        $.ajax({
            type: "post",
            dataType: 'json',
            data: $("#form-quadra-cadastrar").serialize(),
            url: "/partidamarcada/parqueesportivo/salvar",
            success: function (resposta) {

                if (resposta.status) {
                    $(".resposta-titulo").html("Sucesso");
                    $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                } else {
                    $(".resposta-titulo").html("Erro");
                    $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                }
                $(".resposta-mensagem").html(resposta.mensagem);

                $("#resposta").data('dialog').open();
                setTimeout(function () {
                    window.location.href = "/partidamarcada"
                }, 3000);
            }
        });
    })

    //cadastrar partida
    $("#btn-partida-cadastrar").on('click', function () {
        $.ajax({
            type: "post",
            dataType: 'json',
            data: $("#form-partida-cadastrar").serialize(),
            url: "/partidamarcada/partida/salvar",
            success: function (resposta) {  
                console.log(resposta);     
                if (resposta.status) {
                    $(".resposta-titulo").html("Sucesso");
                    $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');  
                    //setTimeout(function () {    
                      //  window.location.href = "/partidamarcada/"
                    //}, 3000);      
                } else {
                    $(".resposta-titulo").html("Erro");                   
                    $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                }          
                $("#resposta").data('dialog').open();  
                $(".resposta-mensagem").html(resposta.mensagem);  
                
                //setTimeout(function () {    
                //    window.location.href = "/partidamarcada/"
               // }, 3000);
            }
        });

        return false;
    });

    //atualizar dados partida
    $("#btn-partida-atualizar").on('click', function () {
        $.ajax({
            type: "post",
            dataType: 'json',
            data: $("#form-partida-atualizar").serialize(),
            url: "/partidamarcada/partida/salvar",
            success: function (resposta) {              
                if (resposta.status) {
                    $(".resposta-titulo").html("Sucesso");
                    $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');                                  
                } else {
                    $(".resposta-titulo").html("Erro");
                    $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');                   
                }      
                
                $(".resposta-mensagem").html(resposta.mensagem); 
                $("#resposta").data('dialog').open();
                
                setTimeout(function () {    
                    window.location.href = "/partidamarcada/partida/gerenciar"
                }, 3000);
            }
        });
    });

    //listar cidades ao alterar estado
    $("#select-estado").on('change', function () {
        $('#select-cidade').val(""),
                buscarCidades($(this).val());
    });
});

//buscar estados
function buscarEstados() {
    $('.estados').remove();
    $.ajax({
        type: "post",
        url: "/partidamarcada/estado/listar",
        dataType: "json",
        success: function (resposta) {
            $.each(resposta, function (k, v) {
                $("#select-estado").append("<option class='estados' value=" + v.id + ">" + v.nome + "</option>");
            });
        }
    });
}

//buscar cidades
function buscarCidades(estado) {
    $('.cidades').remove();
    $.ajax({
        type: "post",
        data: {estado: estado},
        url: "/partidamarcada/cidade/listarPorEstado",
        dataType: 'json',
        success: function (resposta) {

            $.each(resposta, function (k, v) {
                $("#select-cidade").append("<option class='cidades' value=" + v.id + ">" + v.nome + "</option>");
            });
        }
    });
}

//buscar generos
function buscarGeneros() {
    $('.generos').remove();
    $.ajax({
        type: "post",
        url: "/partidamarcada/genero/listar",
        dataType: "json",
        success: function (resposta) {
            $.each(resposta, function (k, v) {
                $("#select-genero").append("<option class='generos' value=" + v.id + ">" + v.nome + "</option>");
            });
        }
    });
}

//buscar visibilidades
function buscarVisibilidades() {
    $('.visibilidades').remove();
    $.ajax({
        type: "post",
        url: "/partidamarcada/visibilidade/listar",
        dataType: "json",
        success: function (resposta) {
            $.each(resposta, function (k, v) {
                $("#select-visibilidade").append("<option class='visibilidades' value=" + v.id + ">" + v.nome + "</option>");
            });
        }
    });
}

//buscar usuário
function buscarUsuario() {
    $.ajax({
        type: "post",
        url: "/partidamarcada/usuario/buscarUsuario",
        dataType: 'json',
        success: function (resposta) {

            buscarCidades(resposta.cidade.estado.id);
            $('#nome').val(resposta.nome);
            $('#sobrenome').val(resposta.sobrenome);
            $('#apelido').val(resposta.apelido);
            $('#endereco').val(resposta.endereco);
            $('#numero').val(resposta.numero);
            $('#ddd').val(resposta.ddd);
            $('#telefone').val(resposta.telefone);
            $('#dt_nascimento').val(resposta.dataNascimento);
            $('#select-estado').val(resposta.cidade.estado.id);
            $('#cep').val(resposta.cep);
            $('#select-visibilidade').val(resposta.visibilidade.id);
            $('#select-genero').val(resposta.genero.id);
            resposta.mostrarTelefone ? $('#mostrar_telefone').val(1) : $('#mostrar_telefone').val(0);
            resposta.mostrarEndereco ? $('#mostrar_endereco').val(1) : $('#mostrar_endereco').val(0);

            $('#id-cidade').val(resposta.cidade.id);
        }
    });
}
