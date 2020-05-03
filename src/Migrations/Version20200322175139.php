<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322175139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE enfant ADD new_etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA2DB243F7C FOREIGN KEY (new_etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('CREATE INDEX IDX_34B70CA2DB243F7C ON enfant (new_etablissement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA2DB243F7C');
        $this->addSql('DROP INDEX IDX_34B70CA2DB243F7C ON enfant');
        $this->addSql('ALTER TABLE enfant DROP new_etablissement_id');
    }
}
