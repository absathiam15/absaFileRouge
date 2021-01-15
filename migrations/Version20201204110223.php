<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204110223 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_competences ADD referentiel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupe_competences ADD CONSTRAINT FK_54FD0400805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id)');
        $this->addSql('CREATE INDEX IDX_54FD0400805DB139 ON groupe_competences (referentiel_id)');
        $this->addSql('ALTER TABLE referentiel DROP FOREIGN KEY FK_B76C2029A660B158');
        $this->addSql('DROP INDEX IDX_B76C2029A660B158 ON referentiel');
        $this->addSql('ALTER TABLE referentiel DROP competences_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_competences DROP FOREIGN KEY FK_54FD0400805DB139');
        $this->addSql('DROP INDEX IDX_54FD0400805DB139 ON groupe_competences');
        $this->addSql('ALTER TABLE groupe_competences DROP referentiel_id');
        $this->addSql('ALTER TABLE referentiel ADD competences_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE referentiel ADD CONSTRAINT FK_B76C2029A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B76C2029A660B158 ON referentiel (competences_id)');
    }
}
