import './App.css';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Navbar from './components/pages/Navbar';
import BoiteShiny from './views/BoitesShinyView'; // Import du composant

function App() {
  return (
    <Router>
      <Navbar />
      <Routes>
        <Route path="/boite-shiny" element={<BoiteShiny />} />
      </Routes>
    </Router>
  );
}

export default App;
