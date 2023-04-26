<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426080002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plage_horaire_etat (plage_horaire_id INT NOT NULL, etat_id INT NOT NULL, INDEX IDX_566D1DE0B6BCB98B (plage_horaire_id), INDEX IDX_566D1DE0D5E86FF (etat_id), PRIMARY KEY(plage_horaire_id, etat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning_type_plage_horaire (planning_type_id INT NOT NULL, plage_horaire_id INT NOT NULL, INDEX IDX_8EC811271821D178 (planning_type_id), INDEX IDX_8EC81127B6BCB98B (plage_horaire_id), PRIMARY KEY(planning_type_id, plage_horaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plage_horaire_etat ADD CONSTRAINT FK_566D1DE0B6BCB98B FOREIGN KEY (plage_horaire_id) REFERENCES plage_horaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plage_horaire_etat ADD CONSTRAINT FK_566D1DE0D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning_type_plage_horaire ADD CONSTRAINT FK_8EC811271821D178 FOREIGN KEY (planning_type_id) REFERENCES planning_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning_type_plage_horaire ADD CONSTRAINT FK_8EC81127B6BCB98B FOREIGN KEY (plage_horaire_id) REFERENCES plage_horaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plage_horaire_etat DROP FOREIGN KEY FK_566D1DE0B6BCB98B');
        $this->addSql('ALTER TABLE plage_horaire_etat DROP FOREIGN KEY FK_566D1DE0D5E86FF');
        $this->addSql('ALTER TABLE planning_type_plage_horaire DROP FOREIGN KEY FK_8EC811271821D178');
        $this->addSql('ALTER TABLE planning_type_plage_horaire DROP FOREIGN KEY FK_8EC81127B6BCB98B');
        $this->addSql('DROP TABLE plage_horaire_etat');
        $this->addSql('DROP TABLE planning_type_plage_horaire');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }
}
