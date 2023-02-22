<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222123851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rune (id INT AUTO_INCREMENT NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistic ADD rune_id INT NOT NULL');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CE8E5031 FOREIGN KEY (rune_id) REFERENCES rune (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_649B469CE8E5031 ON statistic (rune_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CE8E5031');
        $this->addSql('DROP TABLE rune');
        $this->addSql('DROP INDEX UNIQ_649B469CE8E5031 ON statistic');
        $this->addSql('ALTER TABLE statistic DROP rune_id');
    }
}
