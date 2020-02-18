<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200217190836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE enfant_responsable_legal (enfant_id INT NOT NULL, responsable_legal_id INT NOT NULL, INDEX IDX_3B709A61450D2529 (enfant_id), INDEX IDX_3B709A6146135043 (responsable_legal_id), PRIMARY KEY(enfant_id, responsable_legal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant_sejour (enfant_id INT NOT NULL, sejour_id INT NOT NULL, INDEX IDX_159E7E65450D2529 (enfant_id), INDEX IDX_159E7E6584CF0CF (sejour_id), PRIMARY KEY(enfant_id, sejour_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_affaire_affaire (liste_affaire_id INT NOT NULL, affaire_id INT NOT NULL, INDEX IDX_CA81ADF3E2687AC3 (liste_affaire_id), INDEX IDX_CA81ADF3F082E755 (affaire_id), PRIMARY KEY(liste_affaire_id, affaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enfant_responsable_legal ADD CONSTRAINT FK_3B709A61450D2529 FOREIGN KEY (enfant_id) REFERENCES enfant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant_responsable_legal ADD CONSTRAINT FK_3B709A6146135043 FOREIGN KEY (responsable_legal_id) REFERENCES responsable_legal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant_sejour ADD CONSTRAINT FK_159E7E65450D2529 FOREIGN KEY (enfant_id) REFERENCES enfant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant_sejour ADD CONSTRAINT FK_159E7E6584CF0CF FOREIGN KEY (sejour_id) REFERENCES sejour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_affaire_affaire ADD CONSTRAINT FK_CA81ADF3E2687AC3 FOREIGN KEY (liste_affaire_id) REFERENCES liste_affaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_affaire_affaire ADD CONSTRAINT FK_CA81ADF3F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affaire ADD type_affaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE affaire ADD CONSTRAINT FK_9C3F18EFED813170 FOREIGN KEY (type_affaire_id) REFERENCES type_affaire (id)');
        $this->addSql('CREATE INDEX IDX_9C3F18EFED813170 ON affaire (type_affaire_id)');
        $this->addSql('ALTER TABLE enfant ADD etablissement_id INT DEFAULT NULL, ADD centre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA2FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA2463CD7C3 FOREIGN KEY (centre_id) REFERENCES centre (id)');
        $this->addSql('CREATE INDEX IDX_34B70CA2FF631228 ON enfant (etablissement_id)');
        $this->addSql('CREATE INDEX IDX_34B70CA2463CD7C3 ON enfant (centre_id)');
        $this->addSql('ALTER TABLE sejour ADD liste_affaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F52028E2687AC3 FOREIGN KEY (liste_affaire_id) REFERENCES liste_affaire (id)');
        $this->addSql('CREATE INDEX IDX_96F52028E2687AC3 ON sejour (liste_affaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE enfant_responsable_legal');
        $this->addSql('DROP TABLE enfant_sejour');
        $this->addSql('DROP TABLE liste_affaire_affaire');
        $this->addSql('ALTER TABLE affaire DROP FOREIGN KEY FK_9C3F18EFED813170');
        $this->addSql('DROP INDEX IDX_9C3F18EFED813170 ON affaire');
        $this->addSql('ALTER TABLE affaire DROP type_affaire_id');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA2FF631228');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA2463CD7C3');
        $this->addSql('DROP INDEX IDX_34B70CA2FF631228 ON enfant');
        $this->addSql('DROP INDEX IDX_34B70CA2463CD7C3 ON enfant');
        $this->addSql('ALTER TABLE enfant DROP etablissement_id, DROP centre_id');
        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F52028E2687AC3');
        $this->addSql('DROP INDEX IDX_96F52028E2687AC3 ON sejour');
        $this->addSql('ALTER TABLE sejour DROP liste_affaire_id');
    }
}
