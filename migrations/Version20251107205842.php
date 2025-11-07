<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251107205842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adoption_application (id INT AUTO_INCREMENT NOT NULL, applicant_id INT DEFAULT NULL, animal_id INT DEFAULT NULL, message LONGTEXT NOT NULL, status VARCHAR(12) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', processed_at DATETIME DEFAULT NULL, INDEX IDX_22268C3097139001 (applicant_id), INDEX IDX_22268C308E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, shelter_id INT NOT NULL, species_id INT NOT NULL, breed_id INT DEFAULT NULL, medical_record_id INT DEFAULT NULL, name VARCHAR(120) NOT NULL, slug VARCHAR(160) NOT NULL, sex VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, size VARCHAR(255) DEFAULT NULL, color VARCHAR(80) DEFAULT NULL, description LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, cover_path VARCHAR(255) DEFAULT NULL, INDEX IDX_6AAB231F54053EC0 (shelter_id), INDEX IDX_6AAB231FB2A1D860 (species_id), INDEX IDX_6AAB231FA8B4A30F (breed_id), UNIQUE INDEX UNIQ_6AAB231FB88E2BB6 (medical_record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_photo (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, path VARCHAR(255) NOT NULL, is_cover TINYINT(1) NOT NULL, INDEX IDX_35445DEC8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_tag (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_9C07FC6D8E962C16 (animal_id), INDEX IDX_9C07FC6DBAD26311 (tag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE breed (id INT AUTO_INCREMENT NOT NULL, species_id INT NOT NULL, name VARCHAR(120) NOT NULL, slug VARCHAR(150) NOT NULL, INDEX IDX_F8AF884FB2A1D860 (species_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, animal_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_68C58ED9A76ED395 (user_id), INDEX IDX_68C58ED98E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_record (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, vaccinated TINYINT(1) DEFAULT 0 NOT NULL, chipped TINYINT(1) DEFAULT 0 NOT NULL, sterilized TINYINT(1) DEFAULT 0 NOT NULL, last_vet_visit_at DATE DEFAULT NULL, notes LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_F06A283E8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shelter (id INT AUTO_INCREMENT NOT NULL, manager_id INT NOT NULL, name VARCHAR(150) NOT NULL, slug VARCHAR(180) NOT NULL, description LONGTEXT NOT NULL, email VARCHAR(180) NOT NULL, phone VARCHAR(30) DEFAULT NULL, address_line1 VARCHAR(180) NOT NULL, address_line2 VARCHAR(180) DEFAULT NULL, postal_code VARCHAR(20) NOT NULL, city VARCHAR(120) NOT NULL, country VARCHAR(2) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_71106707783E3463 (manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE species (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, slug VARCHAR(120) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, slug VARCHAR(120) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', fullname VARCHAR(100) NOT NULL, phone VARCHAR(30) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adoption_application ADD CONSTRAINT FK_22268C3097139001 FOREIGN KEY (applicant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE adoption_application ADD CONSTRAINT FK_22268C308E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F54053EC0 FOREIGN KEY (shelter_id) REFERENCES shelter (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FB2A1D860 FOREIGN KEY (species_id) REFERENCES species (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FB88E2BB6 FOREIGN KEY (medical_record_id) REFERENCES medical_record (id)');
        $this->addSql('ALTER TABLE animal_photo ADD CONSTRAINT FK_35445DEC8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_tag ADD CONSTRAINT FK_9C07FC6D8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_tag ADD CONSTRAINT FK_9C07FC6DBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE breed ADD CONSTRAINT FK_F8AF884FB2A1D860 FOREIGN KEY (species_id) REFERENCES species (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED98E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medical_record ADD CONSTRAINT FK_F06A283E8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shelter ADD CONSTRAINT FK_71106707783E3463 FOREIGN KEY (manager_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adoption_application DROP FOREIGN KEY FK_22268C3097139001');
        $this->addSql('ALTER TABLE adoption_application DROP FOREIGN KEY FK_22268C308E962C16');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F54053EC0');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FB2A1D860');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FA8B4A30F');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FB88E2BB6');
        $this->addSql('ALTER TABLE animal_photo DROP FOREIGN KEY FK_35445DEC8E962C16');
        $this->addSql('ALTER TABLE animal_tag DROP FOREIGN KEY FK_9C07FC6D8E962C16');
        $this->addSql('ALTER TABLE animal_tag DROP FOREIGN KEY FK_9C07FC6DBAD26311');
        $this->addSql('ALTER TABLE breed DROP FOREIGN KEY FK_F8AF884FB2A1D860');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9A76ED395');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED98E962C16');
        $this->addSql('ALTER TABLE medical_record DROP FOREIGN KEY FK_F06A283E8E962C16');
        $this->addSql('ALTER TABLE shelter DROP FOREIGN KEY FK_71106707783E3463');
        $this->addSql('DROP TABLE adoption_application');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE animal_photo');
        $this->addSql('DROP TABLE animal_tag');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE favorite');
        $this->addSql('DROP TABLE medical_record');
        $this->addSql('DROP TABLE shelter');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
