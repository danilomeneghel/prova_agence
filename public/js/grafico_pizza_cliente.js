var dynamicColors = function() {
  var r = Math.floor(Math.random() * 255);
  var g = Math.floor(Math.random() * 255);
  var b = Math.floor(Math.random() * 255);
  return "rgb(" + r + "," + g + "," + b + ")";
}

var nomes = $('input:checked[id=desemp_porcentual_cliente]').map(function() {
     return new Array(this.name);
}).get();

var receitas = $('input:checked[id=desemp_porcentual_cliente]').map(function() {
     return new Array(this.value);
}).get();

var cores = $('input:checked[id=desemp_porcentual_cliente]').map(function() {
     return dynamicColors();
}).get();

new Chart(document.getElementById("grafico_pizza_cliente"), {
    type: 'pie',
    data: {
      labels: nomes,
      datasets: [{
        label: "Receita Total %",
        backgroundColor: cores,
        data: receitas,
        fill: true
      }]
    },
    options: {
      legend: {
        display: false
      },
      title: {
        display: true,
        text: 'Desempenho dos Clientes (%)'
      },
      legend: { display: true }
    }
});
