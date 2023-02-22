<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222162022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rune DROP FOREIGN KEY FK_74EECE4E53B6268F');
        $this->addSql('DROP INDEX UNIQ_74EECE4E53B6268F ON rune');
        $this->addSql('ALTER TABLE rune DROP statistic_id, CHANGE price price INT DEFAULT NULL');
        $this->addSql('ALTER TABLE server ADD name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CF353B9EA');
        $this->addSql('DROP INDEX UNIQ_649B469CF353B9EA ON statistic');
        $this->addSql('ALTER TABLE statistic ADD rune_id INT DEFAULT NULL, ADD value VARCHAR(50) NOT NULL, DROP rune_id_id, DROP max, DROP min');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CE8E5031 FOREIGN KEY (rune_id) REFERENCES rune (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_649B469CE8E5031 ON statistic (rune_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rune ADD statistic_id INT NOT NULL, CHANGE price price INT NOT NULL');
        $this->addSql('ALTER TABLE rune ADD CONSTRAINT FK_74EECE4E53B6268F FOREIGN KEY (statistic_id) REFERENCES statistic (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_74EECE4E53B6268F ON rune (statistic_id)');
        $this->addSql('ALTER TABLE server DROP name');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CE8E5031');
        $this->addSql('DROP INDEX UNIQ_649B469CE8E5031 ON statistic');
        $this->addSql('ALTER TABLE statistic ADD rune_id_id INT NOT NULL, ADD max INT NOT NULL, ADD min INT NOT NULL, DROP rune_id, DROP value');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CF353B9EA FOREIGN KEY (rune_id_id) REFERENCES rune (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_649B469CF353B9EA ON statistic (rune_id_id)');
    }
}
