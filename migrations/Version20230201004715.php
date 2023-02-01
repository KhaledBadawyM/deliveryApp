<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201004715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE biker (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcel (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, biker_id INT DEFAULT NULL, description LONGTEXT NOT NULL, pick_up LONGTEXT NOT NULL, drop_off LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, picked_at DATETIME DEFAULT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_C99B5D60F624B39D (sender_id), INDEX IDX_C99B5D6082150208 (biker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sender (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parcel ADD CONSTRAINT FK_C99B5D60F624B39D FOREIGN KEY (sender_id) REFERENCES sender (id)');
        $this->addSql('ALTER TABLE parcel ADD CONSTRAINT FK_C99B5D6082150208 FOREIGN KEY (biker_id) REFERENCES biker (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parcel DROP FOREIGN KEY FK_C99B5D6082150208');
        $this->addSql('ALTER TABLE parcel DROP FOREIGN KEY FK_C99B5D60F624B39D');
        $this->addSql('DROP TABLE biker');
        $this->addSql('DROP TABLE parcel');
        $this->addSql('DROP TABLE sender');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
