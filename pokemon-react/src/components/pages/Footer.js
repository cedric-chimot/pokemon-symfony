import "bootstrap/dist/css/bootstrap.min.css";
import "../../assets/styles/footer.css";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faCopyright } from "@fortawesome/free-regular-svg-icons";

const Footer = () => {
  return (
    <footer className="footer">
      <p>
        <FontAwesomeIcon icon={faCopyright} />
        <span> Pokemon Manager</span> | <span>Tous droits réservés</span> |{" "}
        <span>Cédric Chimot - 2025</span>
      </p>
    </footer>
  );
};

export default Footer;
