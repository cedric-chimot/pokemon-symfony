<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250305230937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boite_shiny_nature (id INT AUTO_INCREMENT NOT NULL, boite_shiny_id INT NOT NULL, nature_id INT NOT NULL, nb_pokemon INT NOT NULL, INDEX IDX_18F556C7E8E6FB28 (boite_shiny_id), INDEX IDX_18F556C73BCB2E4B (nature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boite_shiny_pokeball (id INT AUTO_INCREMENT NOT NULL, boite_shiny_id INT NOT NULL, pokeball_id INT NOT NULL, nb_pokemon INT NOT NULL, INDEX IDX_36583651E8E6FB28 (boite_shiny_id), INDEX IDX_3658365198C742A2 (pokeball_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boite_shiny_nature ADD CONSTRAINT FK_18F556C7E8E6FB28 FOREIGN KEY (boite_shiny_id) REFERENCES boites_shiny (id)');
        $this->addSql('ALTER TABLE boite_shiny_nature ADD CONSTRAINT FK_18F556C73BCB2E4B FOREIGN KEY (nature_id) REFERENCES natures (id)');
        $this->addSql('ALTER TABLE boite_shiny_pokeball ADD CONSTRAINT FK_36583651E8E6FB28 FOREIGN KEY (boite_shiny_id) REFERENCES boites_shiny (id)');
        $this->addSql('ALTER TABLE boite_shiny_pokeball ADD CONSTRAINT FK_3658365198C742A2 FOREIGN KEY (pokeball_id) REFERENCES pokeballs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boite_shiny_nature DROP FOREIGN KEY FK_18F556C7E8E6FB28');
        $this->addSql('ALTER TABLE boite_shiny_nature DROP FOREIGN KEY FK_18F556C73BCB2E4B');
        $this->addSql('ALTER TABLE boite_shiny_pokeball DROP FOREIGN KEY FK_36583651E8E6FB28');
        $this->addSql('ALTER TABLE boite_shiny_pokeball DROP FOREIGN KEY FK_3658365198C742A2');
        $this->addSql('DROP TABLE boite_shiny_nature');
        $this->addSql('DROP TABLE boite_shiny_pokeball');
    }
}
