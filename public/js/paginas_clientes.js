function clienteRelatorio() {
    var form_data = $('#cliente_form').serialize();
    $.ajax({
      url: $('#cliente_url_relatorio').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      success:function(data) {
        $('#container-gl-cliente').remove();
        $('#container-gp-cliente').remove();
        $('#cliente_relatorio').html(data);
      }
    });
}

function clienteGraficoLinha() {
    var form_data = $('#cliente_form').serialize();
    $.ajax({
      url: $('#cliente_url_grafico_linha').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      async: true,
      success:function(data) {
        $('#container-r-cliente').remove();
        $('#container-gp-cliente').remove();
        $('#cliente_grafico_linha').html(data);
      }
    });
}

function clienteGraficoPizza() {
    var form_data = $('#cliente_form').serialize();
    $.ajax({
      url: $('#cliente_url_grafico_pizza').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      async: true,
      success:function(data) {
        $('#container-r-cliente').remove();
        $('#container-gl-cliente').remove();
        $('#cliente_grafico_pizza').html(data);
      }
    });
}
