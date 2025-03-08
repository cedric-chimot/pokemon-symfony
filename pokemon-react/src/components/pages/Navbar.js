import { useState } from 'react';
import { Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import logoPokemon from '../assets/img/logoPokemon.png'; // Ajuste le chemin si nécessaire

const Navbar = () => {
  const [isOpen, setIsOpen] = useState(false);

  const toggleNav = () => {
    setIsOpen(!isOpen);
  };

  return (
    <nav className="navbar navbar-expand-lg navbar-primary bg-primary">
      <div className="container-fluid">
        {/* Logo + Lien vers la page d'accueil */}
        <Link className="navbar-brand text-white mr-4" to="/home">
          <img src={logoPokemon} alt="Pokemon Logo" className="logo-pokemon" /> Manager
        </Link>

        {/* Bouton hamburger pour mobiles */}
        <button className="navbar-toggler" type="button" onClick={toggleNav}>
          <span className="navbar-toggler-icon"></span>
        </button>

        {/* Menu déroulant */}
        <div className={`collapse navbar-collapse ${isOpen ? 'show' : ''}`}>
          <ul className="navbar-nav ms-auto">
            <li className="nav-item">
              <Link className="nav-link text-white me-3" to="/admin-home">Admin</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link text-white me-3" to="/pokedex-national">Pokedex National</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link text-white me-3" to="/stats-pokedex">Stats Pokedex</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link text-white me-3" to="/boite-shiny">Boîtes Shiny</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link text-white me-3" to="/pokedex-shiny">Pokedex Shiny</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link text-white me-3" to="/stats-generales">Stats Générales</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link text-white" to="/stats">Stats par Boites</Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
