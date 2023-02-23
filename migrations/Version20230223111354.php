<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223111354 extends AbstractMigration
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
        $this->addSql('CREATE TABLE rune (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, price INT DEFAULT NULL, weight INT NOT NULL, statistic VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server (id INT AUTO_INCREMENT NOT NULL, ratio INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server_item (server_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_949B54FE1844E6B7 (server_id), INDEX IDX_949B54FE126F525E (item_id), PRIMARY KEY(server_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, rune_id INT NOT NULL, name VARCHAR(50) NOT NULL, value VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_649B469CE8E5031 (rune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_statistic ADD CONSTRAINT FK_6841506C126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_statistic ADD CONSTRAINT FK_6841506C53B6268F FOREIGN KEY (statistic_id) REFERENCES statistic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_ingredient ADD CONSTRAINT FK_D61E507A126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_ingredient ADD CONSTRAINT FK_D61E507A933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE server_item ADD CONSTRAINT FK_949B54FE1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE server_item ADD CONSTRAINT FK_949B54FE126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CE8E5031 FOREIGN KEY (rune_id) REFERENCES rune (id)');
        $this->addSql("INSERT INTO rune (name, weight, statistic) VALUES ('ine',1,'Intelligence'),('do terre',5,'Dommages Terre'),('fo',1,'Force'),('vi',1,'Vitalité'),('sa',3,'Sagesse'),('GaPa',100,'PA');");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_statistic DROP FOREIGN KEY FK_6841506C126F525E');
        $this->addSql('ALTER TABLE item_statistic DROP FOREIGN KEY FK_6841506C53B6268F');
        $this->addSql('ALTER TABLE item_ingredient DROP FOREIGN KEY FK_D61E507A126F525E');
        $this->addSql('ALTER TABLE item_ingredient DROP FOREIGN KEY FK_D61E507A933FE08C');
        $this->addSql('ALTER TABLE server_item DROP FOREIGN KEY FK_949B54FE1844E6B7');
        $this->addSql('ALTER TABLE server_item DROP FOREIGN KEY FK_949B54FE126F525E');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CE8E5031');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_statistic');
        $this->addSql('DROP TABLE item_ingredient');
        $this->addSql('DROP TABLE rune');
        $this->addSql('DROP TABLE server');
        $this->addSql('DROP TABLE server_item');
        $this->addSql('DROP TABLE statistic');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
