<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211114233129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD temoignage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCF2410A1E FOREIGN KEY (temoignage_id) REFERENCES temoignage (id)');
        $this->addSql('CREATE INDEX IDX_67F068BCF2410A1E ON commentaire (temoignage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCF2410A1E');
        $this->addSql('DROP INDEX IDX_67F068BCF2410A1E ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP temoignage_id');
    }
}
