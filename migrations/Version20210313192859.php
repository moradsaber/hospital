<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210313192859 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, bed_id INT DEFAULT NULL, sexe VARCHAR(255) NOT NULL, reserved_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, leave_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C8495588688BB9 ON reservation (bed_id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495588688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP TABLE reservation');
    }
}
