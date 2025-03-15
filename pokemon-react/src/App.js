import './App.css';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Navbar from './components/pages/Navbar';
import HomeView from './views/HomeView'; // Import du composant HomePage
import BoiteShiny from './views/BoitesShinyView'; // Import du composant BoiteShiny
import Footer from './components/pages/Footer';

function App() {
  return (
    <Router>
      <Navbar />
      <Routes>
        <Route path="/" element={<HomeView />} /> {/* Page d'accueil */}
        <Route path="/boite-shiny" element={<BoiteShiny />} />
      </Routes>
      <Footer />
    </Router>
  );
}

export default App;
