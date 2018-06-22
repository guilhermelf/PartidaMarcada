/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () { 

    //funcao validar data
    function validarData(data) {
        var comp = data.split('/');
        var m = parseInt(comp[1], 10);
        var d = parseInt(comp[0], 10);
        var y = parseInt(comp[2], 10);
        var date = new Date(y,m-1,d);

        console.log(hoje.getTime());
        console.log(date.getTime());

        if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
            return 1;
        } else {
            return 0;
        }
    }

    //funcao validar data futura
    function validarDataFutura(data) {
        var comp = data.split('/');
        var m = parseInt(comp[1], 10);
        var d = parseInt(comp[0], 10);
        var y = parseInt(comp[2], 10);
        var date = new Date(y,m-1,d);     
        
        var data = new Date();
        var day = data.getDate();
        var month = data.getMonth();
        var year = data.getFullYear();

        var hoje = new Date(year, month, day);

        if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
            if(date.getTime() > hoje.getTime()) {
                return 1;
            } else {    
                return 0;
            }
        } else {
            return 0;
        }
    }

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

    //cadastrar parque esportivo
    $("#btn-quadra-cadastrar").on('click', function () {

        $.ajax({
            type: "post",
            dataType: 'json',
            data: $("#form-quadra-cadastrar").serialize(),
            url: "/partidamarcada/parqueEsportivo/salvar",
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

        var valid = 1,
        message = '';

        $('#form-partida-cadastrar input').each(function() {        
            var $this = $(this);
                
            if(!$this.val()) {
                var inputName = $this.attr('name');
                
                if(inputName == "id_parque") {
                    valid = 0;
                    message += 'Selecione um parque esportivo!<br />';
                } else if(inputName == "quadra") {
                    valid = 0;
                    message += 'Selecione uma quadra!<br />';
                } else if(inputName == "data") {
                    valid = 0;
                    message += 'Selecione uma data!<br />';
                } else if(inputName == "jogadores") {
                    valid = 0;
                    message += 'Informe o número de jogadores!<br />';
                } 
            }            
        });

        if(valid) {
            if($('#select-esporte').val() == 0) {
                valid = 0;
                message += 'Selecione um esporte!<br />';
            } 
        }

        if(valid) {
            $.ajax({
                type: "post",
                dataType: 'json',
                data: $("#form-partida-cadastrar").serialize(),
                url: "/partidamarcada/partida/salvar",
                success: function (resposta) {    
                    if (resposta.status) {
                        $(".resposta-titulo").html("Sucesso");
                        $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');  
                    } else {
                        $(".resposta-titulo").html("Erro");                   
                        $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                    }          
                    $("#resposta").data('dialog').open();  
                    $(".resposta-mensagem").html(resposta.mensagem);
                    setTimeout(function () {    
                        window.location.href = "/partidamarcada/partida/gerenciar"
                    }, 2000);   
                }
            });

            return false;
        } else {
            $(".resposta-titulo").html("Erro");
            $(".resposta-mensagem").html(message);
            $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');

            $("#resposta").data('dialog').open();

            return false;
        }
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
