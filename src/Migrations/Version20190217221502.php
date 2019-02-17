<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190217221502 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE guardian_child DROP FOREIGN KEY FK_7C84459211CC8B0A');
        $this->addSql('CREATE TABLE user_child (user_id INT NOT NULL, child_id INT NOT NULL, INDEX IDX_C071AF71A76ED395 (user_id), INDEX IDX_C071AF71DD62C21B (child_id), PRIMARY KEY(user_id, child_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_child ADD CONSTRAINT FK_C071AF71A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_child ADD CONSTRAINT FK_C071AF71DD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE guardian');
        $this->addSql('DROP TABLE guardian_child');
        $this->addSql('DROP TABLE nurse');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(50) NOT NULL, ADD lastname VARCHAR(50) NOT NULL, ADD phone VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE guardian (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, firstname VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, lastname VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, phone VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_64486055A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE guardian_child (guardian_id INT NOT NULL, child_id INT NOT NULL, INDEX IDX_7C84459211CC8B0A (guardian_id), INDEX IDX_7C844592DD62C21B (child_id), PRIMARY KEY(guardian_id, child_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE nurse (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, firstname VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, lastname VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, phone VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_D27E6D43A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE guardian ADD CONSTRAINT FK_64486055A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE guardian_child ADD CONSTRAINT FK_7C84459211CC8B0A FOREIGN KEY (guardian_id) REFERENCES guardian (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guardian_child ADD CONSTRAINT FK_7C844592DD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nurse ADD CONSTRAINT FK_D27E6D43A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE user_child');
        $this->addSql('ALTER TABLE user DROP firstname, DROP lastname, DROP phone');
    }
}
