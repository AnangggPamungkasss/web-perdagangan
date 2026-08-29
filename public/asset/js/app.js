let markers = {}; 
    let map;

    function initMap() {
        const GorontaloCenter = [0.548922, 122.9988206];
        map = L.map('map').setView(GorontaloCenter, 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        function createInfoCard(nama_pasar, alamat) {
            return `
                <div class="info-card">
                    <h4>${nama_pasar}</h4>
                    <p>${alamat}</p>
                    <a href="/index/tampil_lapak?pasar=${encodeURIComponent(nama_pasar)}" class="btn btn-primary">detail</a>
                </div>
            `;
        }

        function loadPasarData(query = '') {
            fetch(`/api/pasar-locations?keyword=${query}`)
                .then(response => response.json())
                .then(data => {
                    map.eachLayer(layer => {
                        if (layer instanceof L.Marker) {
                            map.removeLayer(layer);
                        }
                    });
                    markers = {};

                    data.forEach(location => {
                        const marker = L.marker([location.latitude, location.longitude]).addTo(map);
                        marker.bindPopup(createInfoCard(location.nama_pasar, location.alamat));

                        markers[location.nama_pasar] = marker;
                    });

                    if (data.length > 0) {
                        map.setView([data[0].latitude, data[0].longitude], 13);
                    }
                })
                .catch(error => console.error('Error fetching locations:', error));
        }

        loadPasarData();

        document.getElementById('search-button').addEventListener('click', function() {
            const query = document.getElementById('search-input').value;
            openPasarPopup(query);
        });

        document.getElementById('search-input').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') { 
                const query = document.getElementById('search-input').value;
                openPasarPopup(query);
            }
        });
    }

    function openPasarPopup(query) {
        if (markers[query]) {
            markers[query].openPopup();
        } else {
            alert('Pasar tidak ditemukan');
        }
    }

    window.onload = initMap;