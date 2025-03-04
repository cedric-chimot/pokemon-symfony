<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304230257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boite_shiny_dresseur (id INT AUTO_INCREMENT NOT NULL, boite_shiny_id INT NOT NULL, dresseur_id INT NOT NULL, nb_pokemon INT NOT NULL, INDEX IDX_93A9FB81E8E6FB28 (boite_shiny_id), INDEX IDX_93A9FB81A1A01CBE (dresseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boite_shiny_dresseur ADD CONSTRAINT FK_93A9FB81E8E6FB28 FOREIGN KEY (boite_shiny_id) REFERENCES boites_shiny (id)');
        $this->addSql('ALTER TABLE boite_shiny_dresseur ADD CONSTRAINT FK_93A9FB81A1A01CBE FOREIGN KEY (dresseur_id) REFERENCES dresseurs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boite_shiny_dresseur DROP FOREIGN KEY FK_93A9FB81E8E6FB28');
        $this->addSql('ALTER TABLE boite_shiny_dresseur DROP FOREIGN KEY FK_93A9FB81A1A01CBE');
        $this->addSql('DROP TABLE boite_shiny_dresseur');
    }
}
