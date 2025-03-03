<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250303120446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boites_shiny (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, nb_level100 INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dresseurs (id INT AUTO_INCREMENT NOT NULL, region_dresseur_id INT DEFAULT NULL, num_dresseur VARCHAR(255) NOT NULL, nom_dresseur VARCHAR(255) NOT NULL, nb_pokemon INT NOT NULL, nb_shiny INT DEFAULT NULL, INDEX IDX_697E42A1768C2964 (region_dresseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemon_shiny (id INT AUTO_INCREMENT NOT NULL, nature_id INT NOT NULL, dresseur_id INT NOT NULL, pokeball_id INT NOT NULL, type1_id INT NOT NULL, type2_id INT DEFAULT NULL, genre_id INT NOT NULL, attaque1_id INT DEFAULT NULL, attaque2_id INT DEFAULT NULL, attaque3_id INT DEFAULT NULL, attaque4_id INT DEFAULT NULL, boite_id INT NOT NULL, region_id INT NOT NULL, num_dex VARCHAR(255) NOT NULL, nom_pokemon VARCHAR(255) NOT NULL, iv_manquants VARCHAR(255) NOT NULL, position INT NOT NULL, INDEX IDX_FC8A74A43BCB2E4B (nature_id), INDEX IDX_FC8A74A4A1A01CBE (dresseur_id), INDEX IDX_FC8A74A498C742A2 (pokeball_id), INDEX IDX_FC8A74A4BFAFA3E1 (type1_id), INDEX IDX_FC8A74A4AD1A0C0F (type2_id), INDEX IDX_FC8A74A44296D31F (genre_id), INDEX IDX_FC8A74A425C4D33C (attaque1_id), INDEX IDX_FC8A74A437717CD2 (attaque2_id), INDEX IDX_FC8A74A48FCD1BB7 (attaque3_id), INDEX IDX_FC8A74A4121A230E (attaque4_id), INDEX IDX_FC8A74A43C43472D (boite_id), INDEX IDX_FC8A74A498260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region_dresseur (id INT AUTO_INCREMENT NOT NULL, nom_region_dresseur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regions (id INT AUTO_INCREMENT NOT NULL, nom_region VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dresseurs ADD CONSTRAINT FK_697E42A1768C2964 FOREIGN KEY (region_dresseur_id) REFERENCES region_dresseur (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A43BCB2E4B FOREIGN KEY (nature_id) REFERENCES natures (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A4A1A01CBE FOREIGN KEY (dresseur_id) REFERENCES dresseurs (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A498C742A2 FOREIGN KEY (pokeball_id) REFERENCES pokeballs (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A4BFAFA3E1 FOREIGN KEY (type1_id) REFERENCES types (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A4AD1A0C0F FOREIGN KEY (type2_id) REFERENCES types (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A44296D31F FOREIGN KEY (genre_id) REFERENCES genres (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A425C4D33C FOREIGN KEY (attaque1_id) REFERENCES attaques (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A437717CD2 FOREIGN KEY (attaque2_id) REFERENCES attaques (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A48FCD1BB7 FOREIGN KEY (attaque3_id) REFERENCES attaques (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A4121A230E FOREIGN KEY (attaque4_id) REFERENCES attaques (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A43C43472D FOREIGN KEY (boite_id) REFERENCES boites_shiny (id)');
        $this->addSql('ALTER TABLE pokemon_shiny ADD CONSTRAINT FK_FC8A74A498260155 FOREIGN KEY (region_id) REFERENCES regions (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dresseurs DROP FOREIGN KEY FK_697E42A1768C2964');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A43BCB2E4B');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A4A1A01CBE');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A498C742A2');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A4BFAFA3E1');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A4AD1A0C0F');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A44296D31F');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A425C4D33C');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A437717CD2');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A48FCD1BB7');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A4121A230E');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A43C43472D');
        $this->addSql('ALTER TABLE pokemon_shiny DROP FOREIGN KEY FK_FC8A74A498260155');
        $this->addSql('DROP TABLE boites_shiny');
        $this->addSql('DROP TABLE dresseurs');
        $this->addSql('DROP TABLE pokemon_shiny');
        $this->addSql('DROP TABLE region_dresseur');
        $this->addSql('DROP TABLE regions');
    }
}
