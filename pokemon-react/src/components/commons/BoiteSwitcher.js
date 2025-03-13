import React from 'react';

const BoiteSwitcher = ({ boites, currentBoiteId, onBoiteChange }) => {
  return (
    <div className="d-flex flex-wrap justify-content-center gap-2 mb-4">
      {boites.map((boite) => (
        <button
          key={boite.id}
          className={`btn ${boite.id === currentBoiteId ? 'btn-primary' : 'btn-outline-primary'}`}
          onClick={() => onBoiteChange(boite.id)}
        >
          {boite.nom}
        </button>
      ))}
    </div>
  );
};

export default BoiteSwitcher;
