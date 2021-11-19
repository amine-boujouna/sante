<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211114232538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, commentaires VARCHAR(2000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, minicontenu VARCHAR(1000) DEFAULT NULL, maxcontenu VARCHAR(5000) NOT NULL, nbrlike INT DEFAULT NULL, nbrdislike INT DEFAULT NULL, nbrparticipants INT DEFAULT NULL, dateevent DATETIME DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, phone INT NOT NULL, rate INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temoignage (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, temoignage VARCHAR(5000) NOT NULL, titre VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_BDADBC4671F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE temoignage ADD CONSTRAINT FK_BDADBC4671F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE temoignage DROP FOREIGN KEY FK_BDADBC4671F7E88B');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE temoignage');
    }
}
