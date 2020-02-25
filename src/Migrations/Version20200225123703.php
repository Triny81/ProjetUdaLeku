<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225123703 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE affaire (id INT AUTO_INCREMENT NOT NULL, type_affaire_id INT DEFAULT NULL, nom_franã§ais VARCHAR(40) NOT NULL, nom_basque VARCHAR(40) NOT NULL, INDEX IDX_9C3F18EFED813170 (type_affaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centre (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable_legal (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, tel_dom VARCHAR(10) DEFAULT NULL, tel_port VARCHAR(10) NOT NULL, tel_trav VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE correspondant_administratif (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, tel_dom VARCHAR(10) DEFAULT NULL, tel_port VARCHAR(10) NOT NULL, tel_trav VARCHAR(10) DEFAULT NULL, nâ°_secu VARCHAR(20) NOT NULL, aide_caf VARCHAR(30) DEFAULT NULL, aide_msa VARCHAR(30) DEFAULT NULL, aide_autres VARCHAR(40) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT DEFAULT NULL, centre_id INT DEFAULT NULL, nom VARCHAR(40) NOT NULL, prenom VARCHAR(40) NOT NULL, date_naiss DATE NOT NULL, remarque LONGTEXT DEFAULT NULL, adresse_1 VARCHAR(255) NOT NULL, adresse_2 VARCHAR(255) DEFAULT NULL, ville VARCHAR(50) NOT NULL, code_postal VARCHAR(6) NOT NULL, INDEX IDX_34B70CA2FF631228 (etablissement_id), INDEX IDX_34B70CA2463CD7C3 (centre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant_responsable_legal (enfant_id INT NOT NULL, responsable_legal_id INT NOT NULL, INDEX IDX_3B709A61450D2529 (enfant_id), INDEX IDX_3B709A6146135043 (responsable_legal_id), PRIMARY KEY(enfant_id, responsable_legal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant_sejour (enfant_id INT NOT NULL, sejour_id INT NOT NULL, INDEX IDX_159E7E65450D2529 (enfant_id), INDEX IDX_159E7E6584CF0CF (sejour_id), PRIMARY KEY(enfant_id, sejour_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) NOT NULL, ville VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_affaire (id INT AUTO_INCREMENT NOT NULL, nom_franã§ais VARCHAR(30) NOT NULL, nom_basque VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_affaire_affaire (liste_affaire_id INT NOT NULL, affaire_id INT NOT NULL, INDEX IDX_CA81ADF3E2687AC3 (liste_affaire_id), INDEX IDX_CA81ADF3F082E755 (affaire_id), PRIMARY KEY(liste_affaire_id, affaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sejour (id INT AUTO_INCREMENT NOT NULL, liste_affaire_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, nâ°_ministre VARCHAR(20) NOT NULL, cout INT NOT NULL, INDEX IDX_96F52028E2687AC3 (liste_affaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_affaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affaire ADD CONSTRAINT FK_9C3F18EFED813170 FOREIGN KEY (type_affaire_id) REFERENCES type_affaire (id)');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA2FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA2463CD7C3 FOREIGN KEY (centre_id) REFERENCES centre (id)');
        $this->addSql('ALTER TABLE enfant_responsable_legal ADD CONSTRAINT FK_3B709A61450D2529 FOREIGN KEY (enfant_id) REFERENCES enfant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant_responsable_legal ADD CONSTRAINT FK_3B709A6146135043 FOREIGN KEY (responsable_legal_id) REFERENCES responsable_legal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant_sejour ADD CONSTRAINT FK_159E7E65450D2529 FOREIGN KEY (enfant_id) REFERENCES enfant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant_sejour ADD CONSTRAINT FK_159E7E6584CF0CF FOREIGN KEY (sejour_id) REFERENCES sejour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_affaire_affaire ADD CONSTRAINT FK_CA81ADF3E2687AC3 FOREIGN KEY (liste_affaire_id) REFERENCES liste_affaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_affaire_affaire ADD CONSTRAINT FK_CA81ADF3F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F52028E2687AC3 FOREIGN KEY (liste_affaire_id) REFERENCES liste_affaire (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE liste_affaire_affaire DROP FOREIGN KEY FK_CA81ADF3F082E755');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA2463CD7C3');
        $this->addSql('ALTER TABLE enfant_responsable_legal DROP FOREIGN KEY FK_3B709A6146135043');
        $this->addSql('ALTER TABLE enfant_responsable_legal DROP FOREIGN KEY FK_3B709A61450D2529');
        $this->addSql('ALTER TABLE enfant_sejour DROP FOREIGN KEY FK_159E7E65450D2529');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA2FF631228');
        $this->addSql('ALTER TABLE liste_affaire_affaire DROP FOREIGN KEY FK_CA81ADF3E2687AC3');
        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F52028E2687AC3');
        $this->addSql('ALTER TABLE enfant_sejour DROP FOREIGN KEY FK_159E7E6584CF0CF');
        $this->addSql('ALTER TABLE affaire DROP FOREIGN KEY FK_9C3F18EFED813170');
        $this->addSql('DROP TABLE affaire');
        $this->addSql('DROP TABLE centre');
        $this->addSql('DROP TABLE responsable_legal');
        $this->addSql('DROP TABLE correspondant_administratif');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('DROP TABLE enfant_responsable_legal');
        $this->addSql('DROP TABLE enfant_sejour');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE liste_affaire');
        $this->addSql('DROP TABLE liste_affaire_affaire');
        $this->addSql('DROP TABLE sejour');
        $this->addSql('DROP TABLE type_affaire');
        $this->addSql('DROP TABLE user');
    }
}
