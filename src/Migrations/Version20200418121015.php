<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200418121015 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE affaire (id INT AUTO_INCREMENT NOT NULL, type_affaire_id INT DEFAULT NULL, nom_francais VARCHAR(40) NOT NULL, nom_basque VARCHAR(40) NOT NULL, INDEX IDX_9C3F18EFED813170 (type_affaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affaire_liste_affaire (affaire_id INT NOT NULL, liste_affaire_id INT NOT NULL, INDEX IDX_80DBABFCF082E755 (affaire_id), INDEX IDX_80DBABFCE2687AC3 (liste_affaire_id), PRIMARY KEY(affaire_id, liste_affaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_affaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT DEFAULT NULL, centre_id INT DEFAULT NULL, responsable_legal_id INT DEFAULT NULL, correspondant_administratif_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, remarque LONGTEXT DEFAULT NULL, adresse_1 VARCHAR(255) NOT NULL, adresse_2 VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(10) NOT NULL, INDEX IDX_34B70CA2FF631228 (etablissement_id), INDEX IDX_34B70CA2463CD7C3 (centre_id), INDEX IDX_34B70CA246135043 (responsable_legal_id), INDEX IDX_34B70CA25D493FF4 (correspondant_administratif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant_sejour (enfant_id INT NOT NULL, sejour_id INT NOT NULL, INDEX IDX_159E7E65450D2529 (enfant_id), INDEX IDX_159E7E6584CF0CF (sejour_id), PRIMARY KEY(enfant_id, sejour_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sejour (id INT AUTO_INCREMENT NOT NULL, liste_affaire_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, num_ministre VARCHAR(20) NOT NULL, cout INT NOT NULL, INDEX IDX_96F52028E2687AC3 (liste_affaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centre (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE correspondant_administratif (id INT AUTO_INCREMENT NOT NULL, responsable_legal_id INT DEFAULT NULL, num_secu VARCHAR(255) NOT NULL, aide_caf VARCHAR(255) DEFAULT NULL, aide_msa VARCHAR(255) DEFAULT NULL, aide_autres VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E1E7152E46135043 (responsable_legal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_affaire (id INT AUTO_INCREMENT NOT NULL, nom_francais VARCHAR(255) NOT NULL, nom_basque VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable_legal (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel_dom VARCHAR(255) DEFAULT NULL, tel_port VARCHAR(255) NOT NULL, tel_trav VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affaire ADD CONSTRAINT FK_9C3F18EFED813170 FOREIGN KEY (type_affaire_id) REFERENCES type_affaire (id)');
        $this->addSql('ALTER TABLE affaire_liste_affaire ADD CONSTRAINT FK_80DBABFCF082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affaire_liste_affaire ADD CONSTRAINT FK_80DBABFCE2687AC3 FOREIGN KEY (liste_affaire_id) REFERENCES liste_affaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA2FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA2463CD7C3 FOREIGN KEY (centre_id) REFERENCES centre (id)');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA246135043 FOREIGN KEY (responsable_legal_id) REFERENCES responsable_legal (id)');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA25D493FF4 FOREIGN KEY (correspondant_administratif_id) REFERENCES correspondant_administratif (id)');
        $this->addSql('ALTER TABLE enfant_sejour ADD CONSTRAINT FK_159E7E65450D2529 FOREIGN KEY (enfant_id) REFERENCES enfant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant_sejour ADD CONSTRAINT FK_159E7E6584CF0CF FOREIGN KEY (sejour_id) REFERENCES sejour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F52028E2687AC3 FOREIGN KEY (liste_affaire_id) REFERENCES liste_affaire (id)');
        $this->addSql('ALTER TABLE correspondant_administratif ADD CONSTRAINT FK_E1E7152E46135043 FOREIGN KEY (responsable_legal_id) REFERENCES responsable_legal (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE affaire_liste_affaire DROP FOREIGN KEY FK_80DBABFCF082E755');
        $this->addSql('ALTER TABLE affaire DROP FOREIGN KEY FK_9C3F18EFED813170');
        $this->addSql('ALTER TABLE enfant_sejour DROP FOREIGN KEY FK_159E7E65450D2529');
        $this->addSql('ALTER TABLE enfant_sejour DROP FOREIGN KEY FK_159E7E6584CF0CF');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA2463CD7C3');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA25D493FF4');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA2FF631228');
        $this->addSql('ALTER TABLE affaire_liste_affaire DROP FOREIGN KEY FK_80DBABFCE2687AC3');
        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F52028E2687AC3');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA246135043');
        $this->addSql('ALTER TABLE correspondant_administratif DROP FOREIGN KEY FK_E1E7152E46135043');
        $this->addSql('DROP TABLE affaire');
        $this->addSql('DROP TABLE affaire_liste_affaire');
        $this->addSql('DROP TABLE type_affaire');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('DROP TABLE enfant_sejour');
        $this->addSql('DROP TABLE sejour');
        $this->addSql('DROP TABLE centre');
        $this->addSql('DROP TABLE correspondant_administratif');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE liste_affaire');
        $this->addSql('DROP TABLE responsable_legal');
        $this->addSql('DROP TABLE user');
    }
}
