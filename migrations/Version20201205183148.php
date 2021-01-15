<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201205183148 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_competences DROP FOREIGN KEY FK_54FD0400805DB139');
        $this->addSql('DROP INDEX IDX_54FD0400805DB139 ON groupe_competences');
        $this->addSql('ALTER TABLE groupe_competences DROP referentiel_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_competences ADD referentiel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupe_competences ADD CONSTRAINT FK_54FD0400805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_54FD0400805DB139 ON groupe_competences (referentiel_id)');
    }
}
