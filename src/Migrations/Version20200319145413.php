<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200319145413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE correspondant_administratif ADD responsable_legal_id INT NOT NULL');
        $this->addSql('ALTER TABLE correspondant_administratif ADD CONSTRAINT FK_E1E7152E46135043 FOREIGN KEY (responsable_legal_id) REFERENCES responsable_legal (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1E7152E46135043 ON correspondant_administratif (responsable_legal_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE correspondant_administratif DROP FOREIGN KEY FK_E1E7152E46135043');
        $this->addSql('DROP INDEX UNIQ_E1E7152E46135043 ON correspondant_administratif');
        $this->addSql('ALTER TABLE correspondant_administratif DROP responsable_legal_id');
    }
}
