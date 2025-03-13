import React from 'react';

const ButtonTop = () => {
  const scrollToTop = () => window.scrollTo({ top: 0, behavior: 'smooth' });

  return (
    <button onClick={scrollToTop} className="btn btn-secondary position-fixed bottom-0 end-0 m-3">
      ↑ Haut
    </button>
  );
};

export default ButtonTop;
