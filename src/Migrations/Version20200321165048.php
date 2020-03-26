<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321165048 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE affaire_liste_affaire (affaire_id INT NOT NULL, liste_affaire_id INT NOT NULL, INDEX IDX_80DBABFCF082E755 (affaire_id), INDEX IDX_80DBABFCE2687AC3 (liste_affaire_id), PRIMARY KEY(affaire_id, liste_affaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affaire_liste_affaire ADD CONSTRAINT FK_80DBABFCF082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affaire_liste_affaire ADD CONSTRAINT FK_80DBABFCE2687AC3 FOREIGN KEY (liste_affaire_id) REFERENCES liste_affaire (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE liste_affaire_affaire');
        $this->addSql('ALTER TABLE affaire CHANGE type_affaire_id type_affaire_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE liste_affaire_affaire (liste_affaire_id INT NOT NULL, affaire_id INT NOT NULL, INDEX IDX_CA81ADF3F082E755 (affaire_id), INDEX IDX_CA81ADF3E2687AC3 (liste_affaire_id), PRIMARY KEY(liste_affaire_id, affaire_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE liste_affaire_affaire ADD CONSTRAINT FK_CA81ADF3E2687AC3 FOREIGN KEY (liste_affaire_id) REFERENCES liste_affaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_affaire_affaire ADD CONSTRAINT FK_CA81ADF3F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE affaire_liste_affaire');
        $this->addSql('ALTER TABLE affaire CHANGE type_affaire_id type_affaire_id INT DEFAULT NULL');
    }
}
