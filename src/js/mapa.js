document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    mapa();
}

function mapa(){
    if(document.querySelector('#mapa')){
        
        const lat = 19.4923279;
        const lng = -99.0586138;
        const zoom = 16;
        const map = L.map('mapa').setView([lat, lng], zoom);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup(`
                <h2 class = "mapa__heading">Flawless Mary Nails</h2>
                <p class = "mapa__texto">Nail Artist</p>
            `)
            .openPopup();
    }
}