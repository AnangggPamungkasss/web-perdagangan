window.onload = function() {
    var labels = JSON.parse(document.getElementById('chartLabels').dataset.labels);
    var valuesSentral = JSON.parse(document.getElementById('chartValuesSentral').dataset.values);
    var valuesLiluwo = JSON.parse(document.getElementById('chartValuesLiluwo').dataset.values);

    console.log("Labels:", labels);
    console.log("Values Sentral:", valuesSentral);
    console.log("Values Liluwo:", valuesLiluwo);

    var ctx = document.getElementById('komoditasChart').getContext('2d');
    var komoditasChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pasar Sentral',
                    data: valuesSentral,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Pasar Liluwo',
                    data: valuesLiluwo,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
};
