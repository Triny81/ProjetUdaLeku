<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200316200801 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE affaire CHANGE type_affaire_id type_affaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE correspondant_administratif DROP nom, DROP prenom, DROP email, DROP tel_dom, DROP tel_port, DROP tel_trav, CHANGE id id INT NOT NULL, CHANGE aide_caf aide_caf VARCHAR(30) DEFAULT NULL, CHANGE aide_msa aide_msa VARCHAR(30) DEFAULT NULL, CHANGE aide_autres aide_autres VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE correspondant_administratif ADD CONSTRAINT FK_E1E7152EBF396750 FOREIGN KEY (id) REFERENCES responsable_legal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsable_legal ADD ResponsableLegal VARCHAR(255) NOT NULL, CHANGE tel_dom tel_dom VARCHAR(10) DEFAULT NULL, CHANGE tel_trav tel_trav VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE enfant CHANGE etablissement_id etablissement_id INT DEFAULT NULL, CHANGE centre_id centre_id INT DEFAULT NULL, CHANGE correspondant_administratif_id correspondant_administratif_id INT DEFAULT NULL, CHANGE adresse_2 adresse_2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sejour CHANGE liste_affaire_id liste_affaire_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE affaire CHANGE type_affaire_id type_affaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE correspondant_administratif DROP FOREIGN KEY FK_E1E7152EBF396750');
        $this->addSql('ALTER TABLE correspondant_administratif ADD nom VARCHAR(70) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD tel_dom VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD tel_port VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD tel_trav VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE aide_caf aide_caf VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE aide_msa aide_msa VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE aide_autres aide_autres VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE enfant CHANGE etablissement_id etablissement_id INT DEFAULT NULL, CHANGE centre_id centre_id INT DEFAULT NULL, CHANGE correspondant_administratif_id correspondant_administratif_id INT DEFAULT NULL, CHANGE adresse_2 adresse_2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE responsable_legal DROP ResponsableLegal, CHANGE tel_dom tel_dom VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel_trav tel_trav VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE sejour CHANGE liste_affaire_id liste_affaire_id INT DEFAULT NULL');
    }
}
