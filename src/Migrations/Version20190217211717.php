<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190217211717 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE child ADD nursery_id INT NOT NULL');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429F1795806 FOREIGN KEY (nursery_id) REFERENCES nursery (id)');
        $this->addSql('CREATE INDEX IDX_22B35429F1795806 ON child (nursery_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429F1795806');
        $this->addSql('DROP INDEX IDX_22B35429F1795806 ON child');
        $this->addSql('ALTER TABLE child DROP nursery_id');
    }
}
