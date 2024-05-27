$(function() {
  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  'use strict';
  
  // Récupérer les données depuis l'attribut de données HTML
  var donnees = JSON.parse(document.getElementById('barChart').getAttribute('data-donnees'));

  // Utiliser ces données pour configurer votre graphique
  var data = {
    labels: donnees.map(function(item) { return item.mois; }), // Utiliser les mois récupérés depuis les données
    datasets: [{
      label: '# Montant total',
      data: donnees.map(function(item) { return item.montant_total; }), // Utiliser les montants totaux récupérés depuis les données
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }
  };

  // Afficher le graphique en utilisant les données et les options
  if ($("#barChart").length) {
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: data,
      options: options
    });
  }
});
