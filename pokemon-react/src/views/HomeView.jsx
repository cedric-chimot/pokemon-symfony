import React from "react";
import { Link } from "react-router-dom";
import logoPokemon from "../assets/img/logoPokemon.png";
import "../assets/styles/home.css"; // Assure-toi que ton CSS est bien importé

const Home = ({ nbPokemons, nbShiny, nbDresseurs, nbBoitesShiny }) => {
  return (
    <div className="container mt-4">
      <div className="row">
        <div className="col-lg-12 mb-4">
          <div className="information shadow border m-1 px-3">
            <div className="projet text-center">
              <h1 className="home d-flex align-items-center justify-content-center">
                <img
                  src={logoPokemon}
                  alt="Pokemon Logo"
                  className="logo-pokemon"
                />
                Manager
              </h1>
              <p class="presentation">
                <span
                  >Transformation d'une base de données Excel en projet dynamique :
                </span>&nbsp;
                Le fichier de base permet grâce à Excel d'ajouter des données
                concernant non seulement les pokémons du pokédex maix aussi les
                pokémons chromatiques (shiny), les dresseurs d'origine et plein
                d'autres statistiques. Excel permet la gestion des données sous
                forme de tableaux, les formules de calculs et les fonctions
                permettent une gestion dynamique. La création de graphique est l'une
                des nombreuses options disponibles. Le but de ce projet était de
                recréer le plus fidèlement possible le matériau de base, en y
                apportant si possible des améliorations. Sur Excel, l'insertion de
                lignes de pokédex ou de données statistiques est manuelle, ici le
                but est de le rendre dynamique grâce à la base de données, c'est
                cette dernière qui gérera l'ajout de données grâce à la partie
                administration de l'application.
              </p>
            </div>
          </div>
        </div>

        <div className="d-flex cards-container flex-wrap justify-content-center">
          {/* Carte Pokedex */}
          <div className="card">
            <h5 className="card-header">Pokedex</h5>
            <div className="card-body d-flex flex-column align-items-center text-white">
              <span>(Nb Pokemon)</span>
              <p>{nbPokemons}</p>
              <Link to="/pokedex-national" className="btn btn-pokedex m-4">
                Pokedex
              </Link>
            </div>
          </div>

          {/* Carte Shiny */}
          <div className="card">
            <h5 className="card-header">Pokemon Shiny</h5>
            <div className="card-body d-flex flex-column align-items-center text-white">
              <span>(Nb Shiny)</span>
              <p>{nbShiny}</p>
              <Link to="/pokedex-shiny" className="btn m-4">
                Shiny
              </Link>
            </div>
          </div>

          {/* Carte Dresseurs */}
          <div className="card">
            <h5 className="card-header">Dresseurs</h5>
            <div className="card-body d-flex flex-column align-items-center text-white">
              <span>(Nb Dresseurs)</span>
              <p>{nbDresseurs}</p>
              <Link to="/stats-pokedex" className="btn btn-dresseurs m-4">
                Dresseurs
              </Link>
            </div>
          </div>

          {/* Carte Boites Shiny */}
          <div className="card">
            <h5 className="card-header">Boites Shiny</h5>
            <div className="card-body d-flex flex-column align-items-center text-white">
              <span>(Nb Boites Shiny)</span>
              <p>{nbBoitesShiny}</p>
              <Link to="/boite-shiny" className="btn btn-boites m-4">
                Boites Shiny
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Home;
