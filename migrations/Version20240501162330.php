<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240501162330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compagne_dons (id INT AUTO_INCREMENT NOT NULL, muni_id INT NOT NULL, date_d DATE NOT NULL, date_f DATE NOT NULL, montant_e DOUBLE PRECISION NOT NULL, descrip VARCHAR(255) NOT NULL, total_amount INT DEFAULT NULL, INDEX IDX_E6FA1A24D5CE03AE (muni_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dons (id INT AUTO_INCREMENT NOT NULL, compagne_id INT NOT NULL, montant_don DOUBLE PRECISION NOT NULL, mail_don VARCHAR(255) NOT NULL, cin_don INT NOT NULL, virement_img LONGTEXT NOT NULL, INDEX IDX_E4F955FA8EB43C7 (compagne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE municipaties (id INT AUTO_INCREMENT NOT NULL, nom_muni VARCHAR(255) NOT NULL, adresse_muni VARCHAR(255) NOT NULL, etat_muni VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compagne_dons ADD CONSTRAINT FK_E6FA1A24D5CE03AE FOREIGN KEY (muni_id) REFERENCES municipaties (id)');
        $this->addSql('ALTER TABLE dons ADD CONSTRAINT FK_E4F955FA8EB43C7 FOREIGN KEY (compagne_id) REFERENCES compagne_dons (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compagne_dons DROP FOREIGN KEY FK_E6FA1A24D5CE03AE');
        $this->addSql('ALTER TABLE dons DROP FOREIGN KEY FK_E4F955FA8EB43C7');
        $this->addSql('DROP TABLE compagne_dons');
        $this->addSql('DROP TABLE dons');
        $this->addSql('DROP TABLE municipaties');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
