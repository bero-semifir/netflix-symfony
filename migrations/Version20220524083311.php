<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524083311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_univers (film_id INT NOT NULL, univers_id INT NOT NULL, INDEX IDX_B1138DBE567F5183 (film_id), INDEX IDX_B1138DBE1CF61C0B (univers_id), PRIMARY KEY(film_id, univers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, producteur VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, nombre_episodes INT NOT NULL, date_sortie DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_univers (serie_id INT NOT NULL, univers_id INT NOT NULL, INDEX IDX_6534E53AD94388BD (serie_id), INDEX IDX_6534E53A1CF61C0B (univers_id), PRIMARY KEY(serie_id, univers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE univers (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_univers ADD CONSTRAINT FK_B1138DBE567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_univers ADD CONSTRAINT FK_B1138DBE1CF61C0B FOREIGN KEY (univers_id) REFERENCES univers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_univers ADD CONSTRAINT FK_6534E53AD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_univers ADD CONSTRAINT FK_6534E53A1CF61C0B FOREIGN KEY (univers_id) REFERENCES univers (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE serie_univers DROP FOREIGN KEY FK_6534E53AD94388BD');
        $this->addSql('ALTER TABLE film_univers DROP FOREIGN KEY FK_B1138DBE1CF61C0B');
        $this->addSql('ALTER TABLE serie_univers DROP FOREIGN KEY FK_6534E53A1CF61C0B');
        $this->addSql('DROP TABLE film_univers');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE serie_univers');
        $this->addSql('DROP TABLE univers');
    }
}
