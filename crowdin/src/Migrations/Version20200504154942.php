<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504154942 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(25) DEFAULT NULL, password VARCHAR(505) NOT NULL, picture VARCHAR(255) DEFAULT NULL, langs LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, INDEX IDX_8D93D649166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, content VARCHAR(1000) NOT NULL, locked_translate TINYINT(1) NOT NULL, INDEX IDX_5F8A7F73166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(2000) NOT NULL, lang VARCHAR(55) NOT NULL, target_langs LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, INDEX IDX_2FB3D0EEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE translation (id INT AUTO_INCREMENT NOT NULL, source_id INT NOT NULL, lang VARCHAR(55) NOT NULL, translate_content VARCHAR(1000) NOT NULL, translator_id INT NOT NULL, INDEX IDX_B469456F953C1C61 (source_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F73166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456F953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEA76ED395');
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456F953C1C61');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649166D1F9C');
        $this->addSql('ALTER TABLE source DROP FOREIGN KEY FK_5F8A7F73166D1F9C');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE translation');
    }
}
