<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201127130558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competences (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competences_groupe_competences (competences_id INT NOT NULL, groupe_competences_id INT NOT NULL, INDEX IDX_7FC5C3DBA660B158 (competences_id), INDEX IDX_7FC5C3DBC1218EC1 (groupe_competences_id), PRIMARY KEY(competences_id, groupe_competences_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere_admission (id INT AUTO_INCREMENT NOT NULL, referentiel_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_D65A82E2805DB139 (referentiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere_evaluation (id INT AUTO_INCREMENT NOT NULL, referentiel_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_CB0C6F2F805DB139 (referentiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_competences (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveaux_evaluation (id INT AUTO_INCREMENT NOT NULL, competences_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, criteres VARCHAR(200) NOT NULL, actions VARCHAR(200) NOT NULL, INDEX IDX_F94055F1A660B158 (competences_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referentiel (id INT AUTO_INCREMENT NOT NULL, competences_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, programme VARCHAR(255) NOT NULL, INDEX IDX_B76C2029A660B158 (competences_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competences_groupe_competences ADD CONSTRAINT FK_7FC5C3DBA660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competences_groupe_competences ADD CONSTRAINT FK_7FC5C3DBC1218EC1 FOREIGN KEY (groupe_competences_id) REFERENCES groupe_competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_admission ADD CONSTRAINT FK_D65A82E2805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id)');
        $this->addSql('ALTER TABLE critere_evaluation ADD CONSTRAINT FK_CB0C6F2F805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id)');
        $this->addSql('ALTER TABLE niveaux_evaluation ADD CONSTRAINT FK_F94055F1A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id)');
        $this->addSql('ALTER TABLE referentiel ADD CONSTRAINT FK_B76C2029A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id)');
        $this->addSql('DROP TABLE test');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competences_groupe_competences DROP FOREIGN KEY FK_7FC5C3DBA660B158');
        $this->addSql('ALTER TABLE niveaux_evaluation DROP FOREIGN KEY FK_F94055F1A660B158');
        $this->addSql('ALTER TABLE referentiel DROP FOREIGN KEY FK_B76C2029A660B158');
        $this->addSql('ALTER TABLE competences_groupe_competences DROP FOREIGN KEY FK_7FC5C3DBC1218EC1');
        $this->addSql('ALTER TABLE critere_admission DROP FOREIGN KEY FK_D65A82E2805DB139');
        $this->addSql('ALTER TABLE critere_evaluation DROP FOREIGN KEY FK_CB0C6F2F805DB139');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE competences_groupe_competences');
        $this->addSql('DROP TABLE critere_admission');
        $this->addSql('DROP TABLE critere_evaluation');
        $this->addSql('DROP TABLE groupe_competences');
        $this->addSql('DROP TABLE niveaux_evaluation');
        $this->addSql('DROP TABLE referentiel');
    }
}
