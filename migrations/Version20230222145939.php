<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222145939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic ADD rune_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CF353B9EA FOREIGN KEY (rune_id_id) REFERENCES rune (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_649B469CF353B9EA ON statistic (rune_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CF353B9EA');
        $this->addSql('DROP INDEX UNIQ_649B469CF353B9EA ON statistic');
        $this->addSql('ALTER TABLE statistic DROP rune_id_id');
    }
}
