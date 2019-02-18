<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190218210548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Remove sheetType table (use constant in Sheet entity instead)';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sheet DROP FOREIGN KEY FK_873C91E2C54C8C93');
        $this->addSql('DROP TABLE sheet_type');
        $this->addSql('DROP INDEX IDX_873C91E2C54C8C93 ON sheet');
        $this->addSql('ALTER TABLE sheet CHANGE type_id type INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sheet_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sheet CHANGE type type_id INT NOT NULL');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT FK_873C91E2C54C8C93 FOREIGN KEY (type_id) REFERENCES sheet_type (id)');
        $this->addSql('CREATE INDEX IDX_873C91E2C54C8C93 ON sheet (type_id)');
    }
}
