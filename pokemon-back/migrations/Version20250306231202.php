<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250306231202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boite_shiny_genre (id INT AUTO_INCREMENT NOT NULL, boite_shiny_id INT NOT NULL, genre_id INT NOT NULL, nb_pokemon INT NOT NULL, INDEX IDX_122A0014E8E6FB28 (boite_shiny_id), INDEX IDX_122A00144296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boite_shiny_type (id INT AUTO_INCREMENT NOT NULL, boite_shiny_id INT NOT NULL, type_id INT NOT NULL, nb_pokemon INT NOT NULL, INDEX IDX_92812C67E8E6FB28 (boite_shiny_id), INDEX IDX_92812C67C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boite_shiny_genre ADD CONSTRAINT FK_122A0014E8E6FB28 FOREIGN KEY (boite_shiny_id) REFERENCES boites_shiny (id)');
        $this->addSql('ALTER TABLE boite_shiny_genre ADD CONSTRAINT FK_122A00144296D31F FOREIGN KEY (genre_id) REFERENCES genres (id)');
        $this->addSql('ALTER TABLE boite_shiny_type ADD CONSTRAINT FK_92812C67E8E6FB28 FOREIGN KEY (boite_shiny_id) REFERENCES boites_shiny (id)');
        $this->addSql('ALTER TABLE boite_shiny_type ADD CONSTRAINT FK_92812C67C54C8C93 FOREIGN KEY (type_id) REFERENCES types (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boite_shiny_genre DROP FOREIGN KEY FK_122A0014E8E6FB28');
        $this->addSql('ALTER TABLE boite_shiny_genre DROP FOREIGN KEY FK_122A00144296D31F');
        $this->addSql('ALTER TABLE boite_shiny_type DROP FOREIGN KEY FK_92812C67E8E6FB28');
        $this->addSql('ALTER TABLE boite_shiny_type DROP FOREIGN KEY FK_92812C67C54C8C93');
        $this->addSql('DROP TABLE boite_shiny_genre');
        $this->addSql('DROP TABLE boite_shiny_type');
    }
}
