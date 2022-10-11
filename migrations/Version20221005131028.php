<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005131028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, DROP id_user_avis_id');
        $this->addSql('ALTER TABLE presentation CHANGE activites description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE prestations ADD image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD id_user_avis_id INT NOT NULL, DROP nom, DROP prenom');
        $this->addSql('ALTER TABLE presentation CHANGE description activites VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE prestations DROP image');
    }
}
