<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624160222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tchat CHANGE is?viewed is_viewed TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE doctor_id doctor_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tchat CHANGE is_viewed is?viewed TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE patient_id patient_id INT NOT NULL, CHANGE doctor_id doctor_id INT NOT NULL');
    }
}
