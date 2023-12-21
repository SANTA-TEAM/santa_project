<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221184716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, street_name VARCHAR(255) NOT NULL, street_number VARCHAR(255) NOT NULL, INDEX IDX_D4E6F818BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE age (id INT AUTO_INCREMENT NOT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_64C19C161220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, department_id INT NOT NULL, name VARCHAR(255) NOT NULL, zip_code VARCHAR(5) NOT NULL, INDEX IDX_2D5B0234AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, validator_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, user_name VARCHAR(150) NOT NULL, is_valid TINYINT(1) DEFAULT NULL, INDEX IDX_9474526CB0644AEC (validator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gift (id INT AUTO_INCREMENT NOT NULL, age_id INT DEFAULT NULL, creator_id INT DEFAULT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A47C990DCC80CD12 (age_id), INDEX IDX_A47C990D61220EA6 (creator_id), INDEX IDX_A47C990D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, gift_id INT DEFAULT NULL, file_name VARCHAR(255) NOT NULL, INDEX IDX_C53D045F97A95A83 (gift_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE letter (id INT AUTO_INCREMENT NOT NULL, writer_id INT DEFAULT NULL, title VARCHAR(150) NOT NULL, text LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8E02EE0A1BC7E6B6 (writer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE letter_gift (letter_id INT NOT NULL, gift_id INT NOT NULL, INDEX IDX_23CDA6174525FF26 (letter_id), INDEX IDX_23CDA61797A95A83 (gift_id), PRIMARY KEY(letter_id, gift_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, writer_id INT DEFAULT NULL, title VARCHAR(150) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_B6BD307F1BC7E6B6 (writer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reindeers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, ceated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', story VARCHAR(255) NOT NULL, file_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, age INT DEFAULT NULL, ceated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F818BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C161220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB0644AEC FOREIGN KEY (validator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE gift ADD CONSTRAINT FK_A47C990DCC80CD12 FOREIGN KEY (age_id) REFERENCES age (id)');
        $this->addSql('ALTER TABLE gift ADD CONSTRAINT FK_A47C990D61220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE gift ADD CONSTRAINT FK_A47C990D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F97A95A83 FOREIGN KEY (gift_id) REFERENCES gift (id)');
        $this->addSql('ALTER TABLE letter ADD CONSTRAINT FK_8E02EE0A1BC7E6B6 FOREIGN KEY (writer_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE letter_gift ADD CONSTRAINT FK_23CDA6174525FF26 FOREIGN KEY (letter_id) REFERENCES letter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE letter_gift ADD CONSTRAINT FK_23CDA61797A95A83 FOREIGN KEY (gift_id) REFERENCES gift (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1BC7E6B6 FOREIGN KEY (writer_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F818BAC62AF');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C161220EA6');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234AE80F5DF');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB0644AEC');
        $this->addSql('ALTER TABLE gift DROP FOREIGN KEY FK_A47C990DCC80CD12');
        $this->addSql('ALTER TABLE gift DROP FOREIGN KEY FK_A47C990D61220EA6');
        $this->addSql('ALTER TABLE gift DROP FOREIGN KEY FK_A47C990D12469DE2');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F97A95A83');
        $this->addSql('ALTER TABLE letter DROP FOREIGN KEY FK_8E02EE0A1BC7E6B6');
        $this->addSql('ALTER TABLE letter_gift DROP FOREIGN KEY FK_23CDA6174525FF26');
        $this->addSql('ALTER TABLE letter_gift DROP FOREIGN KEY FK_23CDA61797A95A83');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1BC7E6B6');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE age');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE gift');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE letter');
        $this->addSql('DROP TABLE letter_gift');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE reindeers');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
