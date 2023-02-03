<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202194440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parcel (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, pick_up LONGTEXT NOT NULL, drop_off LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, picked_at DATETIME DEFAULT NULL, delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcel_user (parcel_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9B9D3D76465E670C (parcel_id), INDEX IDX_9B9D3D76A76ED395 (user_id), PRIMARY KEY(parcel_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parcel_user ADD CONSTRAINT FK_9B9D3D76465E670C FOREIGN KEY (parcel_id) REFERENCES parcel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parcel_user ADD CONSTRAINT FK_9B9D3D76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parcel_user DROP FOREIGN KEY FK_9B9D3D76465E670C');
        $this->addSql('DROP TABLE parcel');
        $this->addSql('DROP TABLE parcel_user');
    }
}
