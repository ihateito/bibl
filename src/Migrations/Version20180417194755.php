<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180417194755 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE books ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE books ALTER name DROP DEFAULT');
        $this->addSql('ALTER TABLE books ALTER annotation TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE books ALTER annotation DROP DEFAULT');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE books ALTER name TYPE BYTEA');
        $this->addSql('ALTER TABLE books ALTER name DROP DEFAULT');
        $this->addSql('ALTER TABLE books ALTER annotation TYPE BYTEA');
        $this->addSql('ALTER TABLE books ALTER annotation DROP DEFAULT');
    }
}
