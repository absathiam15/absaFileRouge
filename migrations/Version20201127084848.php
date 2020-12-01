<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201127084848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE group_tags (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags_group_tags (tags_id INT NOT NULL, group_tags_id INT NOT NULL, INDEX IDX_245FD3B78D7B4FB4 (tags_id), INDEX IDX_245FD3B7B7B1BB8 (group_tags_id), PRIMARY KEY(tags_id, group_tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tags_group_tags ADD CONSTRAINT FK_245FD3B78D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tags_group_tags ADD CONSTRAINT FK_245FD3B7B7B1BB8 FOREIGN KEY (group_tags_id) REFERENCES group_tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tags_group_tags DROP FOREIGN KEY FK_245FD3B7B7B1BB8');
        $this->addSql('ALTER TABLE tags_group_tags DROP FOREIGN KEY FK_245FD3B78D7B4FB4');
        $this->addSql('DROP TABLE group_tags');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE tags_group_tags');
    }
}
