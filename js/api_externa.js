// assets/js/api_externa.js

document.addEventListener('DOMContentLoaded', () => {
    // Generamos un número aleatorio entre 1 y 151 (Pokémon originales)
    const idRandom = Math.floor(Math.random() * 151) + 1;

    // 1. Llamamos a una API EXTERNA (PokeAPI)
    fetch(`https://pokeapi.co/api/v2/pokemon/${idRandom}`)
        .then(response => response.json())
        .then(data => {
            console.log("=== API EXTERNA (PokeAPI) ===");
            console.log("He traído a: " + data.name);

            // 2. Buscamos el hueco en el HTML donde ponerlo
            const contenedor = document.getElementById('mascota-pokemon');
            
            if (contenedor) {
                // 3. Inyectamos el HTML dinámicamente
                contenedor.innerHTML = `
                    <div class="text-center mt-3">
                        <p class="small text-muted mb-0">Visitante Aleatorio (API Externa)</p>
                        <img src="${data.sprites.front_default}" alt="${data.name}" style="width: 80px;">
                        <p class="fw-bold text-capitalize" style="font-size: 0.9rem;">${data.name}</p>
                    </div>
                `;
            }
        })
        .catch(error => console.error('Error en API Externa:', error));
});