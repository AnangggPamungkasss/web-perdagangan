const labels = JSON.parse(document.getElementById('chartLabels').dataset.labels); // Tanggal
const dataSentral = JSON.parse(document.getElementById('chartSentral').dataset.values); // Harga Pasar Sentral
const dataLiluwo = JSON.parse(document.getElementById('chartLiluwo').dataset.values); // Harga Pasar Liluwo

// Pastikan semua tanggal memiliki nilai, jika tidak, set ke 0
const fillMissingData = (labels, data) => {
    return labels.map((label, index) => data[index] ?? 0);
};

const fixedDataSentral = fillMissingData(labels, dataSentral);
const fixedDataLiluwo = fillMissingData(labels, dataLiluwo);

const ctx = document.getElementById('komoditasChart').getContext('2d');
const komoditasChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Pasar Sentral',
                data: fixedDataSentral,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false,
            },
            {
                label: 'Pasar Liluwo',
                data: fixedDataLiluwo,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: false,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Harga Komoditas Per Pasar'
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Tanggal'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Harga'
                }
            }
        }
    }
});
