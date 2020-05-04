<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504174200 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649166D1F9C ON user (project_id)');
        $this->addSql('ALTER TABLE source CHANGE project_id project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F73166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_5F8A7F73166D1F9C ON source (project_id)');
        $this->addSql('ALTER TABLE project CHANGE description description VARCHAR(2000) NOT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EEA76ED395 ON project (user_id)');
        $this->addSql('ALTER TABLE translation CHANGE source_id source_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456F953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
        $this->addSql('CREATE INDEX IDX_B469456F953C1C61 ON translation (source_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEA76ED395');
        $this->addSql('DROP INDEX IDX_2FB3D0EEA76ED395 ON project');
        $this->addSql('ALTER TABLE project CHANGE user_id user_id INT NOT NULL, CHANGE description description VARCHAR(2000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE source DROP FOREIGN KEY FK_5F8A7F73166D1F9C');
        $this->addSql('DROP INDEX IDX_5F8A7F73166D1F9C ON source');
        $this->addSql('ALTER TABLE source CHANGE project_id project_id INT NOT NULL');
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456F953C1C61');
        $this->addSql('DROP INDEX IDX_B469456F953C1C61 ON translation');
        $this->addSql('ALTER TABLE translation CHANGE source_id source_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649166D1F9C');
        $this->addSql('DROP INDEX IDX_8D93D649166D1F9C ON user');
        $this->addSql('ALTER TABLE user DROP project_id');
    }
}
