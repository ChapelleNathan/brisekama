<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230225003914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, ankama_id INT NOT NULL, img_url VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, ankama_id INT NOT NULL, name VARCHAR(50) NOT NULL, level INT NOT NULL, type VARCHAR(50) NOT NULL, img_url VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_ingredient (id INT AUTO_INCREMENT NOT NULL, item_id INT NOT NULL, ingredient_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_D61E507A126F525E (item_id), INDEX IDX_D61E507A933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_statistic (id INT AUTO_INCREMENT NOT NULL, item_id INT NOT NULL, statistic_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_6841506C126F525E (item_id), INDEX IDX_6841506C53B6268F (statistic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rune (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, price INT DEFAULT NULL, weight INT NOT NULL, statistic VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server_item (server_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_949B54FE1844E6B7 (server_id), INDEX IDX_949B54FE126F525E (item_id), PRIMARY KEY(server_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, rune_id INT NOT NULL, name VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_649B469CE8E5031 (rune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_ingredient ADD CONSTRAINT FK_D61E507A126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item_ingredient ADD CONSTRAINT FK_D61E507A933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE item_statistic ADD CONSTRAINT FK_6841506C126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item_statistic ADD CONSTRAINT FK_6841506C53B6268F FOREIGN KEY (statistic_id) REFERENCES statistic (id)');
        $this->addSql('ALTER TABLE server_item ADD CONSTRAINT FK_949B54FE1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE server_item ADD CONSTRAINT FK_949B54FE126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CE8E5031 FOREIGN KEY (rune_id) REFERENCES rune (id)');
        $this->addSql("INSERT INTO rune (name, weight, statistic) VALUES ('ine',1,'Intelligence'),('fo',1,'Force'),('cha',1,'chance'),('age',1,'Agilité'),('vi',1,'Vitalité'),('ini',1,'Initiative'),
        ('sa',3,'Sagesse'),('prospe',3,'Prospection'),('pui',2,'Puissance'),('ré terre',2,'Résistance Terre'),('ré feu',2,'Résitance Feu'),('ré eau',2,'Résistance Eau'),
        ('ré air',2,'Résistance Air'),('ré neutre',2,'Résistance Neutre'),('ré per air',6,'% Résistance Air'),('ré per terre',6,'% Résistance Terre'),
        ('ré per feu',6,'% Résistance Feu'),('ré per eau',6,'% Résistance Eau'),('ré per neutre',6,'% Résistance Neutre'),('ré pou',2,'Résistance Poussée'),
        ('ré cri',2,'Résistance Critiques'),('ré pa',7,'Esquive PA'),('ré pm',7,'Esquive PM'),('ret pa',7,'Retrait PA'),('ret pm',7,'Retrait PM'),('pod',2.5,'Pods'),
        ('tac',4,'Tacle'),('fui',4,'Fuite'),('do',20,'Dommages'),('do terre',5,'Dommages Terre'),('do neutre',5,'Dommages Neutre'),('do feu',5,'Dommages Feu'),
        ('do air',5,'Dommages Air'),('do eau',5,'Dommages Eau'),('do pou',5,'Dommages Poussée'),('do cri',5,'Dommages Critiques'),('do pi',5,'Dommages Pièges'),
        ('do per di',15,'% Dommages distance'),('do per ar',15,'% Dommages d\'armes'),('do per so',15,'% Dommages aux sorts'),('do per mé',15,'% Dommages mêlée'),
        ('ré per mé',15,'% Résitance mêlée'),('ré per di',15,'% Résistance distance'),('pi per',2,'Puissance (pièges)'),('so',10,'Soins'),('cri',10,'% Critique'),
        ('do ren',10,'Renvoie dommages'),('invo',30,'Invocations'),('po',51,'Portée'),('ga pm',90,'PM'),('ga pa',100,'PA')");
        $this->addSql("INSERT INTO server (name) VALUES ('imagiro'),('orukam'),('hell mina'),('tylezia')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_ingredient DROP FOREIGN KEY FK_D61E507A126F525E');
        $this->addSql('ALTER TABLE item_ingredient DROP FOREIGN KEY FK_D61E507A933FE08C');
        $this->addSql('ALTER TABLE item_statistic DROP FOREIGN KEY FK_6841506C126F525E');
        $this->addSql('ALTER TABLE item_statistic DROP FOREIGN KEY FK_6841506C53B6268F');
        $this->addSql('ALTER TABLE server_item DROP FOREIGN KEY FK_949B54FE1844E6B7');
        $this->addSql('ALTER TABLE server_item DROP FOREIGN KEY FK_949B54FE126F525E');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CE8E5031');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_ingredient');
        $this->addSql('DROP TABLE item_statistic');
        $this->addSql('DROP TABLE rune');
        $this->addSql('DROP TABLE server');
        $this->addSql('DROP TABLE server_item');
        $this->addSql('DROP TABLE statistic');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
