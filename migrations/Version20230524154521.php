<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230524154521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, training_id INT DEFAULT NULL, instructor_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date VARCHAR(255) NOT NULL, INDEX IDX_2ED7EC5BEFD98D1 (training_id), INDEX IDX_2ED7EC58C4FC193 (instructor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes_user (classes_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E9AF37279E225B24 (classes_id), INDEX IDX_E9AF3727A76ED395 (user_id), PRIMARY KEY(classes_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trainings (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5BEFD98D1 FOREIGN KEY (training_id) REFERENCES trainings (id)');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC58C4FC193 FOREIGN KEY (instructor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE classes_user ADD CONSTRAINT FK_E9AF37279E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classes_user ADD CONSTRAINT FK_E9AF3727A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5BEFD98D1');
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC58C4FC193');
        $this->addSql('ALTER TABLE classes_user DROP FOREIGN KEY FK_E9AF37279E225B24');
        $this->addSql('ALTER TABLE classes_user DROP FOREIGN KEY FK_E9AF3727A76ED395');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE classes_user');
        $this->addSql('DROP TABLE trainings');
    }
}
