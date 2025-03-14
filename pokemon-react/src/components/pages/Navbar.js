import { useState } from "react";
import { Link, useLocation } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import logoPokemon from "../../assets/img/logoPokemon.png";
import "../../assets/styles/navbar.css"; // Import du CSS

const Navbar = () => {
  const [isOpen, setIsOpen] = useState(false);
  const location = useLocation(); // Récupère la route actuelle

  const toggleNav = () => {
    setIsOpen(!isOpen);
  };

  return (
    <nav className="navbar navbar-expand-lg navbar-primary">
      <div className="container-fluid">
        {/* Logo + Lien vers la page d'accueil */}
        <Link className="navbar-brand text-white mr-4" to="/">
          <img src={logoPokemon} alt="Pokemon Logo" className="logo-pokemon-navbar" /> Manager
        </Link>

        {/* Bouton hamburger pour mobiles */}
        <button className="navbar-toggler" type="button" onClick={toggleNav}>
          <span className="navbar-toggler-icon"></span>
        </button>

        {/* Menu déroulant */}
        <div className={`collapse navbar-collapse ${isOpen ? "show" : ""}`}>
          <ul className="navbar-nav ms-auto">
            <li className="nav-item">
              <Link className={`nav-link text-white me-3 ${location.pathname === "/admin-home" ? "active" : ""}`} to="/admin-home">
                Admin
              </Link>
            </li>
            <li className="nav-item">
              <Link className={`nav-link text-white me-3 ${location.pathname === "/pokedex-national" ? "active" : ""}`} to="/pokedex-national">
                Pokedex National
              </Link>
            </li>
            <li className="nav-item">
              <Link className={`nav-link text-white me-3 ${location.pathname === "/stats-pokedex" ? "active" : ""}`} to="/stats-pokedex">
                Stats Pokedex
              </Link>
            </li>
            <li className="nav-item">
              <Link className={`nav-link text-white me-3 ${location.pathname === "/boite-shiny" ? "active" : ""}`} to="/boite-shiny">
                Boîtes Shiny
              </Link>
            </li>
            <li className="nav-item">
              <Link className={`nav-link text-white me-3 ${location.pathname === "/pokedex-shiny" ? "active" : ""}`} to="/pokedex-shiny">
                Pokedex Shiny
              </Link>
            </li>
            <li className="nav-item">
              <Link className={`nav-link text-white me-3 ${location.pathname === "/stats-generales" ? "active" : ""}`} to="/stats-generales">
                Stats Générales
              </Link>
            </li>
            <li className="nav-item">
              <Link className={`nav-link text-white ${location.pathname === "/stats" ? "active" : ""}`} to="/stats">
                Stats par Boites
              </Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
