<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429014938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE claim (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, tel INT NOT NULL, content VARCHAR(1000) NOT NULL, image VARCHAR(1000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clean (id INT AUTO_INCREMENT NOT NULL, circuit_name VARCHAR(255) NOT NULL, discription VARCHAR(1000) NOT NULL, image VARCHAR(1000) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, responsible VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, tel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pai (id INT AUTO_INCREMENT NOT NULL, file VARCHAR(1000) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, pai_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, discription VARCHAR(1000) NOT NULL, file VARCHAR(255) DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, status TINYINT(1) DEFAULT NULL, INDEX IDX_2FB3D0EEC19C5634 (pai_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEC19C5634 FOREIGN KEY (pai_id) REFERENCES pai (id)');
        $this->addSql('ALTER TABLE article CHANGE datedebut datedebut DATE DEFAULT NULL, CHANGE datefin datefin DATE DEFAULT NULL, CHANGE expiration expiration TINYINT(1) DEFAULT NULL, CHANGE file_name file_name VARCHAR(255) DEFAULT NULL, CHANGE tel tel INT DEFAULT NULL, CHANGE repondre repondre TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE file_name file_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEC19C5634');
        $this->addSql('DROP TABLE claim');
        $this->addSql('DROP TABLE clean');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE pai');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE article CHANGE datedebut datedebut DATE DEFAULT \'NULL\', CHANGE datefin datefin DATE DEFAULT \'NULL\', CHANGE expiration expiration TINYINT(1) DEFAULT \'NULL\', CHANGE file_name file_name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE tel tel INT DEFAULT NULL, CHANGE repondre repondre TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE reclamation CHANGE file_name file_name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
