<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129093050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mentions ADD nom VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD proprio VARCHAR(255) NOT NULL, ADD responsable VARCHAR(255) NOT NULL, ADD conception VARCHAR(255) NOT NULL, ADD animation VARCHAR(255) NOT NULL, ADD hebergement VARCHAR(255) NOT NULL, DROP texte');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mentions ADD texte LONGTEXT NOT NULL, DROP nom, DROP adresse, DROP proprio, DROP responsable, DROP conception, DROP animation, DROP hebergement');
    }
}
