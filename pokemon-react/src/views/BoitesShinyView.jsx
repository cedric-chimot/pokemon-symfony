import React, { useState, useEffect } from 'react';
import BoiteSwitcher from '../components/commons/BoiteSwitcher';
import ButtonTop from '../components/commons/ButtonTop';
import '../assets/styles/boite-shiny.css'; // Import du CSS

const BoiteShiny = () => {
  const [pokemonList, setPokemonList] = useState([]);
  const [boite, setBoite] = useState([]);
  const [currentBoiteId, setCurrentBoiteId] = useState(1);

  useEffect(() => {
    loadBoiteShiny(currentBoiteId);
    fetch('/api/boites') // Remplace par ton API
      .then((res) => res.json())
      .then((data) => setBoite(data))
      .catch((err) => console.error(err));
  }, [currentBoiteId]);

  const loadBoiteShiny = (boiteId) => {
    fetch(`/api/pokemon-shiny/${boiteId}`) // Remplace par ton API
      .then((res) => res.json())
      .then((data) => setPokemonList(data))
      .catch((err) => console.error(err));
  };

  const getBoiteName = () => {
    const selectedBoite = boite.find((b) => b.id === currentBoiteId);
    return selectedBoite ? selectedBoite.nom : 'Inconnu';
  };

  const getNbLevel100 = () => {
    const selectedBoite = boite.find((b) => b.id === currentBoiteId);
    return selectedBoite ? selectedBoite.nbLevel100 : 0;
  };

  return (
    <div className="container-fluid mt-4">
      <div className="d-flex flex-wrap justify-content-center gap-2 mb-4">
        <BoiteSwitcher
          boites={boite}
          currentBoiteId={currentBoiteId}
          onBoiteChange={setCurrentBoiteId}
        />
      </div>

      <h2 className="mb-4 text-center" style={{ color: '#008080' }}>
        Pokémon {getBoiteName()}
      </h2>

      <div className="table-responsive">
        <table className="table table-bordered table-hover">
          <thead className="thead-primary">
            <tr>
              {['N°', 'Pokemon', 'Type 1', 'Type 2', 'N° ID', 'PokeBall', 'Attaques', 'Nature', 'Sexe'].map((header) => (
                <th key={header} style={{ backgroundColor: '#008080', color: 'white' }}>{header}</th>
              ))}
            </tr>
          </thead>
          <tbody>
            {pokemonList.map((pokemon, index) => (
              <tr key={index}>
                <td style={{ backgroundColor: '#008080', color: 'white' }}>{pokemon.numDex}</td>
                <td style={{ color: '#191973' }}>{pokemon.nomPokemon}</td>
                <td className="text-center">{pokemon.type1.nomType}</td>
                <td className="text-center">{pokemon.type2?.nomType || ''}</td>
                <td style={{ color: '#191973' }}>{pokemon.dresseur.numDresseur}</td>
                <td style={{ color: '#191973' }}>{pokemon.pokeball.nomPokeball}</td>
                <td>
                  {[pokemon.attaque1, pokemon.attaque2, pokemon.attaque3, pokemon.attaque4]
                    .filter(Boolean)
                    .map((attaque, idx) => (
                      <div key={idx}>{attaque.nomAttaque}</div>
                    ))}
                </td>
                <td style={{ color: '#191973' }}>{pokemon.nature.nomNature}</td>
                <td>
                  <span style={{ fontSize: '1.7rem' }}>{pokemon.sexe.sexe}</span>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      <div className="col-lg-5 col-md-6 mb-3">
        <div className="table-responsive mx-auto mt-4">
          <table className="table table-bordered table-hover" style={{ lineHeight: 2 }}>
            <tr>
              <th style={{ backgroundColor: '#008080', color: 'white' }}>Nb de pokemon niveau 100 :</th>
              <td style={{ backgroundColor: '#e5f2f2' }}>{getNbLevel100()}</td>
            </tr>
          </table>
        </div>
      </div>

      <ButtonTop />
    </div>
  );
};

export default BoiteShiny;
