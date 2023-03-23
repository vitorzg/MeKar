
$("#telefone").mask("(99) 99999-9999");
$("#cpf").mask("999.999.999-99");
$("#ano").mask("9999");
$(function() {
    $('#preco').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
})
