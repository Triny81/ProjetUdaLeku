<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317112845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE enfant_responsable_legal');
        $this->addSql('ALTER TABLE affaire CHANGE type_affaire_id type_affaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE correspondant_administratif CHANGE aide_caf aide_caf VARCHAR(30) DEFAULT NULL, CHANGE aide_msa aide_msa VARCHAR(30) DEFAULT NULL, CHANGE aide_autres aide_autres VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE responsable_legal CHANGE tel_dom tel_dom VARCHAR(10) DEFAULT NULL, CHANGE tel_trav tel_trav VARCHAR(10) DEFAULT NULL, CHANGE responsablelegal correspondant_administratif_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE enfant ADD responsable_legal_id INT DEFAULT NULL, CHANGE etablissement_id etablissement_id INT DEFAULT NULL, CHANGE centre_id centre_id INT DEFAULT NULL, CHANGE correspondant_administratif_id correspondant_administratif_id INT NOT NULL, CHANGE adresse_2 adresse_2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA246135043 FOREIGN KEY (responsable_legal_id) REFERENCES responsable_legal (id)');
        $this->addSql('CREATE INDEX IDX_34B70CA246135043 ON enfant (responsable_legal_id)');
        $this->addSql('ALTER TABLE sejour CHANGE liste_affaire_id liste_affaire_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE enfant_responsable_legal (enfant_id INT NOT NULL, responsable_legal_id INT NOT NULL, INDEX IDX_3B709A61450D2529 (enfant_id), INDEX IDX_3B709A6146135043 (responsable_legal_id), PRIMARY KEY(enfant_id, responsable_legal_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE enfant_responsable_legal ADD CONSTRAINT FK_3B709A61450D2529 FOREIGN KEY (enfant_id) REFERENCES enfant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant_responsable_legal ADD CONSTRAINT FK_3B709A6146135043 FOREIGN KEY (responsable_legal_id) REFERENCES responsable_legal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affaire CHANGE type_affaire_id type_affaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE correspondant_administratif CHANGE aide_caf aide_caf VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE aide_msa aide_msa VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE aide_autres aide_autres VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA246135043');
        $this->addSql('DROP INDEX IDX_34B70CA246135043 ON enfant');
        $this->addSql('ALTER TABLE enfant DROP responsable_legal_id, CHANGE etablissement_id etablissement_id INT DEFAULT NULL, CHANGE centre_id centre_id INT DEFAULT NULL, CHANGE correspondant_administratif_id correspondant_administratif_id INT DEFAULT NULL, CHANGE adresse_2 adresse_2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE responsable_legal CHANGE tel_dom tel_dom VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel_trav tel_trav VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE correspondant_administratif_id ResponsableLegal VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE sejour CHANGE liste_affaire_id liste_affaire_id INT DEFAULT NULL');
    }
}
