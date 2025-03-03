<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250303233153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boite_pokedex_national (id INT AUTO_INCREMENT NOT NULL, nom_boite VARCHAR(255) NOT NULL, nb_males INT NOT NULL, nb_femelles INT NOT NULL, nb_assexues INT NOT NULL, nb_level100 INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokedex_national (id INT AUTO_INCREMENT NOT NULL, nature_id INT NOT NULL, dresseur_id INT NOT NULL, pokeball_id INT NOT NULL, boite_pokedex_id INT NOT NULL, region_id INT NOT NULL, num_dex VARCHAR(255) NOT NULL, nom_pokemon VARCHAR(255) NOT NULL, INDEX IDX_422F5CA43BCB2E4B (nature_id), INDEX IDX_422F5CA4A1A01CBE (dresseur_id), INDEX IDX_422F5CA498C742A2 (pokeball_id), INDEX IDX_422F5CA4933D042C (boite_pokedex_id), INDEX IDX_422F5CA498260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pokedex_national ADD CONSTRAINT FK_422F5CA43BCB2E4B FOREIGN KEY (nature_id) REFERENCES natures (id)');
        $this->addSql('ALTER TABLE pokedex_national ADD CONSTRAINT FK_422F5CA4A1A01CBE FOREIGN KEY (dresseur_id) REFERENCES dresseurs (id)');
        $this->addSql('ALTER TABLE pokedex_national ADD CONSTRAINT FK_422F5CA498C742A2 FOREIGN KEY (pokeball_id) REFERENCES pokeballs (id)');
        $this->addSql('ALTER TABLE pokedex_national ADD CONSTRAINT FK_422F5CA4933D042C FOREIGN KEY (boite_pokedex_id) REFERENCES boite_pokedex_national (id)');
        $this->addSql('ALTER TABLE pokedex_national ADD CONSTRAINT FK_422F5CA498260155 FOREIGN KEY (region_id) REFERENCES regions (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokedex_national DROP FOREIGN KEY FK_422F5CA43BCB2E4B');
        $this->addSql('ALTER TABLE pokedex_national DROP FOREIGN KEY FK_422F5CA4A1A01CBE');
        $this->addSql('ALTER TABLE pokedex_national DROP FOREIGN KEY FK_422F5CA498C742A2');
        $this->addSql('ALTER TABLE pokedex_national DROP FOREIGN KEY FK_422F5CA4933D042C');
        $this->addSql('ALTER TABLE pokedex_national DROP FOREIGN KEY FK_422F5CA498260155');
        $this->addSql('DROP TABLE boite_pokedex_national');
        $this->addSql('DROP TABLE pokedex_national');
    }
}
