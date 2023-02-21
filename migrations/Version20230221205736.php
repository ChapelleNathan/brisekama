<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230221205736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, ankama_id INT NOT NULL, img_url VARCHAR(255) NOT NULL, quantity INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, ankama_id INT NOT NULL, name VARCHAR(50) NOT NULL, level INT NOT NULL, type VARCHAR(50) NOT NULL, img_url VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_statistic (item_id INT NOT NULL, statistic_id INT NOT NULL, INDEX IDX_6841506C126F525E (item_id), INDEX IDX_6841506C53B6268F (statistic_id), PRIMARY KEY(item_id, statistic_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_ingredient (item_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_D61E507A126F525E (item_id), INDEX IDX_D61E507A933FE08C (ingredient_id), PRIMARY KEY(item_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, max INT NOT NULL, min INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_statistic ADD CONSTRAINT FK_6841506C126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_statistic ADD CONSTRAINT FK_6841506C53B6268F FOREIGN KEY (statistic_id) REFERENCES statistic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_ingredient ADD CONSTRAINT FK_D61E507A126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_ingredient ADD CONSTRAINT FK_D61E507A933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_statistic DROP FOREIGN KEY FK_6841506C126F525E');
        $this->addSql('ALTER TABLE item_statistic DROP FOREIGN KEY FK_6841506C53B6268F');
        $this->addSql('ALTER TABLE item_ingredient DROP FOREIGN KEY FK_D61E507A126F525E');
        $this->addSql('ALTER TABLE item_ingredient DROP FOREIGN KEY FK_D61E507A933FE08C');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_statistic');
        $this->addSql('DROP TABLE item_ingredient');
        $this->addSql('DROP TABLE statistic');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
