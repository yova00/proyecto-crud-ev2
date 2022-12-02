<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>LaPokeparada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/solid.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/brands.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/starter-template.css'); ?>">
</head>

<body>

    <!-- main navigation -->
    <?= view('App\Views\auth\components\navbar') ?>

     
    
    <main role="main" class="">
      <div class="jumbotron bg-light">
          <div class="container heroe">
              <h1 class="font-weight-normal">Bienvenido <span class="text-capitalize"><?= $userData['name'] ?></span>!</h1>
              <h2 class="mt-4 font-weight-light">Has iniciado sesion.</h2>
          </div>
      </div>
    </main>

    <section>
    <form action="" onsubmit="searchPokemon(event)">
        <input type="text" name="pokemon" autocomplete="off">
    </form>
    <div data-poke-card class="poke-card">
        <div data-poke-name>Pokedex</div>
        <div data-poke-img-container class="img-container">
            <img data-poke-img class="poke-img" src="./poke-shadow.png"/>
        </div>
        <div data-poke-id></div>
        <div data-poke-types class="poke-types"></div>
        <div data-poke-stats class="poke-stats"></div>
    </div>
    <style>
        form {
    width: 200px;
    margin: 20px auto;
}

input {
    width: 100%;
    padding: 10px;
}

.poke-card {
    position: relative;
    height: fit-content;
    font-family: 'Roboto Mono', monospace;
    max-width: 300px;
    border-radius: 4px;
    color: #000;
    text-align: center;
    padding: 10px;
    margin: 0 auto;
    background-color: #FFF;
    border: 1px solid black;
}

.poke-card::before {
    content: '';
    background: radial-gradient(black 33%, transparent 33%);
    background-size: 3px 3px;
    border-radius: 4px;
    height: 100%;
    width: 100%;
    position: absolute;
    left: 10px;
    top: 10px;
    z-index: -1;
}

.img-container {
    position: relative;
    width: 180px;
    margin: 10px auto;
}

.poke-stats div {
    display: flex;
    justify-content: space-between;
    align-content: space-between;
    padding: 5px;
    font-size: 18px;
}

.poke-types div {
    padding: 5px;
    margin: 5px;
    border-radius: 4px;
    border: 1px dashed black;
}

.poke-img {
    width: 180px;
    border-radius: 50%;
}
    </style>


    <script>
        const pokeCard = document.querySelector('[data-poke-card]');
const pokeName = document.querySelector('[data-poke-name]');
const pokeImg = document.querySelector('[data-poke-img]');
const pokeImgContainer = document.querySelector('[data-poke-img-container]');
const pokeId = document.querySelector('[data-poke-id]');
const pokeTypes = document.querySelector('[data-poke-types]');
const pokeStats = document.querySelector('[data-poke-stats]');

const typeColors = {
    electric: '#FFEA70',
    normal: '#B09398',
    fire: '#FF675C',
    water: '#0596C7',
    ice: '#AFEAFD',
    rock: '#999799',
    flying: '#7AE7C7',
    grass: '#4A9681',
    psychic: '#FFC6D9',
    ghost: '#561D25',
    bug: '#A2FAA3',
    poison: '#795663',
    ground: '#D2B074',
    dragon: '#DA627D',
    steel: '#1D8A99',
    fighting: '#2F2F2F',
    default: '#2A1A1F',
};


const searchPokemon = event => {
    event.preventDefault();
    const { value } = event.target.pokemon;
    fetch(`https://pokeapi.co/api/v2/pokemon/${value.toLowerCase()}`)
        .then(data => data.json())
        .then(response => renderPokemonData(response))
        .catch(err => renderNotFound())
}

const renderPokemonData = data => {
    const sprite =  data.sprites.front_default;
    const { stats, types } = data;

    pokeName.textContent = data.name;
    pokeImg.setAttribute('src', sprite);
    pokeId.textContent = `Nº ${data.id}`;
    setCardColor(types);
    renderPokemonTypes(types);
    renderPokemonStats(stats);
}


const setCardColor = types => {
    const colorOne = typeColors[types[0].type.name];
    const colorTwo = types[1] ? typeColors[types[1].type.name] : typeColors.default;
    pokeImg.style.background =  `radial-gradient(${colorTwo} 33%, ${colorOne} 33%)`;
    pokeImg.style.backgroundSize = ' 5px 5px';
}

const renderPokemonTypes = types => {
    pokeTypes.innerHTML = '';
    types.forEach(type => {
        const typeTextElement = document.createElement("div");
        typeTextElement.style.color = typeColors[type.type.name];
        typeTextElement.textContent = type.type.name;
        pokeTypes.appendChild(typeTextElement);
    });
}

const renderPokemonStats = stats => {
    pokeStats.innerHTML = '';
    stats.forEach(stat => {
        const statElement = document.createElement("div");
        const statElementName = document.createElement("div");
        const statElementAmount = document.createElement("div");
        statElementName.textContent = stat.stat.name;
        statElementAmount.textContent = stat.base_stat;
        statElement.appendChild(statElementName);
        statElement.appendChild(statElementAmount);
        pokeStats.appendChild(statElement);
    });
}

const renderNotFound = () => {
    pokeName.textContent = 'No encontrado';
    pokeImg.setAttribute('src', 'poke-shadow.png');
    pokeImg.style.background =  '#fff';
    pokeTypes.innerHTML = '';
    pokeStats.innerHTML = '';
    pokeId.textContent = '';
}
    </script>
    </section>

    <footer>
      <div class="copyrights">
        <p class="mb-2 mt-2">&copy; <?= date('Y') ?> UAutonoma Estudiantes Desarrollo Web.</p><i class="bi bi-github">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
  <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
</svg> /yova00
</i>
      </div>
    </footer>

    <script src="<?= base_url("vendor/jquery/jquery.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("vendor/bootstrap/js/bootstrap.bundle.min.js") ?>" type="text/javascript"></script>
</body>

</html>