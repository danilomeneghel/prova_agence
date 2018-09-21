function consultorRelatorio() {
    var form_data = $('#consultor_form').serialize();
    $.ajax({
      url: $('#consultor_url_relatorio').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      success:function(data) {
        $('#container-gb-consultor').remove();
        $('#container-gp-consultor').remove();
        $('#consultor_relatorio').html(data);
      }
    });
}

function consultorGraficoBarra() {
    var form_data = $('#consultor_form').serialize();
    $.ajax({
      url: $('#consultor_url_grafico_barra').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      async: true,
      success:function(data) {
        $('#container-r-consultor').remove();
        $('#container-gp-consultor').remove();
        $('#consultor_grafico_barra').html(data);
      }
    });
}

function consultorGraficoPizza() {
    var form_data = $('#consultor_form').serialize();
    $.ajax({
      url: $('#consultor_url_grafico_pizza').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      async: true,
      success:function(data) {
        $('#container-r-consultor').remove();
        $('#container-gb-consultor').remove();
        $('#consultor_grafico_pizza').html(data);
      }
    });
}
