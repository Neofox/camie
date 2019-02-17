<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190111063803 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE child (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, sexe VARCHAR(1) NOT NULL, birthdate DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guardian (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_64486055A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guardian_child (guardian_id INT NOT NULL, child_id INT NOT NULL, INDEX IDX_7C84459211CC8B0A (guardian_id), INDEX IDX_7C844592DD62C21B (child_id), PRIMARY KEY(guardian_id, child_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nurse (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_D27E6D43A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nursery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sheet (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, data JSON DEFAULT NULL, INDEX IDX_873C91E2C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sheet_child (sheet_id INT NOT NULL, child_id INT NOT NULL, INDEX IDX_41E646808B1206A5 (sheet_id), INDEX IDX_41E64680DD62C21B (child_id), PRIMARY KEY(sheet_id, child_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sheet_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, nursery_id INT NOT NULL, login VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, INDEX IDX_8D93D649D60322AC (role_id), INDEX IDX_8D93D649F1795806 (nursery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guardian ADD CONSTRAINT FK_64486055A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE guardian_child ADD CONSTRAINT FK_7C84459211CC8B0A FOREIGN KEY (guardian_id) REFERENCES guardian (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guardian_child ADD CONSTRAINT FK_7C844592DD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nurse ADD CONSTRAINT FK_D27E6D43A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT FK_873C91E2C54C8C93 FOREIGN KEY (type_id) REFERENCES sheet_type (id)');
        $this->addSql('ALTER TABLE sheet_child ADD CONSTRAINT FK_41E646808B1206A5 FOREIGN KEY (sheet_id) REFERENCES sheet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sheet_child ADD CONSTRAINT FK_41E64680DD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F1795806 FOREIGN KEY (nursery_id) REFERENCES nursery (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE guardian_child DROP FOREIGN KEY FK_7C844592DD62C21B');
        $this->addSql('ALTER TABLE sheet_child DROP FOREIGN KEY FK_41E64680DD62C21B');
        $this->addSql('ALTER TABLE guardian_child DROP FOREIGN KEY FK_7C84459211CC8B0A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F1795806');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE sheet_child DROP FOREIGN KEY FK_41E646808B1206A5');
        $this->addSql('ALTER TABLE sheet DROP FOREIGN KEY FK_873C91E2C54C8C93');
        $this->addSql('ALTER TABLE guardian DROP FOREIGN KEY FK_64486055A76ED395');
        $this->addSql('ALTER TABLE nurse DROP FOREIGN KEY FK_D27E6D43A76ED395');
        $this->addSql('DROP TABLE child');
        $this->addSql('DROP TABLE guardian');
        $this->addSql('DROP TABLE guardian_child');
        $this->addSql('DROP TABLE nurse');
        $this->addSql('DROP TABLE nursery');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE sheet');
        $this->addSql('DROP TABLE sheet_child');
        $this->addSql('DROP TABLE sheet_type');
        $this->addSql('DROP TABLE user');
    }
}
