<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230524075151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, training_id_id INT DEFAULT NULL, instructor_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date VARCHAR(255) NOT NULL, INDEX IDX_2ED7EC5909E143A (training_id_id), INDEX IDX_2ED7EC5AD96791B (instructor_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes_user (classes_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E9AF37279E225B24 (classes_id), INDEX IDX_E9AF3727A76ED395 (user_id), PRIMARY KEY(classes_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trainings (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5909E143A FOREIGN KEY (training_id_id) REFERENCES trainings (id)');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5AD96791B FOREIGN KEY (instructor_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE classes_user ADD CONSTRAINT FK_E9AF37279E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classes_user ADD CONSTRAINT FK_E9AF3727A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5909E143A');
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5AD96791B');
        $this->addSql('ALTER TABLE classes_user DROP FOREIGN KEY FK_E9AF37279E225B24');
        $this->addSql('ALTER TABLE classes_user DROP FOREIGN KEY FK_E9AF3727A76ED395');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE classes_user');
        $this->addSql('DROP TABLE trainings');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
