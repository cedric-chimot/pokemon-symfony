<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250301231923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attaques (id INT AUTO_INCREMENT NOT NULL, type_attaque_id INT NOT NULL, nom_attaque VARCHAR(255) NOT NULL, INDEX IDX_59A4878C8C3137 (type_attaque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attaques ADD CONSTRAINT FK_59A4878C8C3137 FOREIGN KEY (type_attaque_id) REFERENCES types (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attaques DROP FOREIGN KEY FK_59A4878C8C3137');
        $this->addSql('DROP TABLE attaques');
    }
}
