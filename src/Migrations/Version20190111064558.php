<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190111064558 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO role (id, name) VALUES (1, 'admin')");
        $this->addSql("INSERT INTO role (id, name) VALUES (2, 'nurse')");
        $this->addSql("INSERT INTO role (id, name) VALUES (3, 'guardian')");

        $this->addSql("INSERT INTO sheet_type (id, name) VALUES (1, 'daily')");
        $this->addSql("INSERT INTO sheet_type (id, name) VALUES (2, 'illness')");
        $this->addSql("INSERT INTO sheet_type (id, name) VALUES (3, 'activity')");
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM role WHERE id IN (1,2,3)');
        $this->addSql('DELETE FROM sheet_type WHERE id IN (1,2,3)');
    }
}
