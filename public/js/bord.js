/** CHART  **/
const labels = [
      'Janvier',
      'Février',
      'Mars',
      'Avril',
      'Mai',
      'Juin'
    ];
    const data = {
      labels: labels,
      datasets: [
        {
          label: "Chiffre d'affaire des 6 derniers mois",
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: [
            0,
            10,
            5,
            2,
            20,
            30,
            45
          ]
        }
      ]
    };
    const config = {
      type: 'line',
      data,
      options: {}
    };

    var myChart = new Chart(document.getElementById('myChart'), config);

    /** CHART2  **/

    const labels2 = ['Janvier','Février','Mars','Avril','Mai','Juin'];
    const data2 = {
    labels: labels2,
    datasets: [{
        label: 'Prospection 6 derniers Mois',
        data: [65, 59, 80, 81, 56, 55],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        ],
        borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        ],
        borderWidth: 1
    }]
    };

const config2 = {
  type: 'bar',
  data: data2,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};

    var myChart2 = new Chart(document.getElementById('myChart2'), config2);

     /** CHART3 */

    var camembert = document.querySelector('.data');
    var part = camembert.dataset.clientPart;
    var perso = camembert.dataset.clientPerso;
    var rs = camembert.dataset.clientRs;

 
    data3 = {
      labels: [
        'Partenaire', 'Réseaux sociaux', 'Personnel'
      ],
      datasets: [
        {
          label: 'Origine client',
          data: [
            part, rs, perso
          ],
          backgroundColor: [
            'rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'
          ],
          hoverOffset: 4
        }
      ]
    };

    const config3 = {
      type: 'pie',
      data: data3
    };

    var myChart3 = new Chart(document.getElementById('myChart3'), config3);

    