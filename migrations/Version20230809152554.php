<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809152554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE courant_musical (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, courant_musical_id INT NOT NULL, nom_du_groupe VARCHAR(50) NOT NULL, origine VARCHAR(50) NOT NULL, ville VARCHAR(50) NOT NULL, annee_debut SMALLINT NOT NULL, annee_separation SMALLINT DEFAULT NULL, fondateurs VARCHAR(255) DEFAULT NULL, members SMALLINT NOT NULL, presentation LONGTEXT DEFAULT NULL, INDEX IDX_4B98C219D0771C1 (courant_musical_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C219D0771C1 FOREIGN KEY (courant_musical_id) REFERENCES courant_musical (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C219D0771C1');
        $this->addSql('DROP TABLE courant_musical');
        $this->addSql('DROP TABLE groupe');
    }
}
