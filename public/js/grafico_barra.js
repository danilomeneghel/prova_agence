var nomes = $('input:checked[id=desemp_consultor]').map(function() {
     return new Array(this.name);
}).get();

var receitas = $('input:checked[id=desemp_consultor]').map(function() {
     return new Array(this.value);
}).get();

var custos = $('input:checked[id=desemp_consultor]').map(function() {
     return $('input:checked[id=custo]').val();
}).get();

var color = Chart.helpers.color;
new Chart(document.getElementById("grafico_barra"), {
    type: 'bar',
    data: {
      labels: nomes,
      datasets: [{
          label: "Custo Médio",
          type: "line",
          borderColor: "#666666",
          data: custos,
          fill: true
        }, {
            label: "Receita Total",
            type: "bar",
            backgroundColor: [
              'rgb(75, 192, 192)',
              'rgb(153, 102, 255)',
              'rgb(255, 99, 132)',
            	'rgb(255, 159, 64)',
              'rgb(54, 162, 235)',
            	'rgb(255, 205, 86)',
            	'rgb(201, 203, 207)'
            ],
            data: receitas,
            fill: true
        }]
    },
    options: {
      title: {
        display: true,
        text: 'Desempenho dos Consultores (R$)'
      },
      legend: { display: true }
    }
});
