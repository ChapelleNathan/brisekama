<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230221214124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE server (id INT AUTO_INCREMENT NOT NULL, ratio INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server_item (server_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_949B54FE1844E6B7 (server_id), INDEX IDX_949B54FE126F525E (item_id), PRIMARY KEY(server_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE server_item ADD CONSTRAINT FK_949B54FE1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE server_item ADD CONSTRAINT FK_949B54FE126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE server_item DROP FOREIGN KEY FK_949B54FE1844E6B7');
        $this->addSql('ALTER TABLE server_item DROP FOREIGN KEY FK_949B54FE126F525E');
        $this->addSql('DROP TABLE server');
        $this->addSql('DROP TABLE server_item');
    }
}
