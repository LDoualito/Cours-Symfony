<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261020162244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE spot (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, type_eau VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE prise ADD spot_id INT NOT NULL, DROP lieu');
        $this->addSql('ALTER TABLE prise ADD CONSTRAINT FK_800A30882DF1D37C FOREIGN KEY (spot_id) REFERENCES spot (id)');
        $this->addSql('CREATE INDEX IDX_800A30882DF1D37C ON prise (spot_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE spot');
        $this->addSql('ALTER TABLE prise DROP FOREIGN KEY FK_800A30882DF1D37C');
        $this->addSql('DROP INDEX IDX_800A30882DF1D37C ON prise');
        $this->addSql('ALTER TABLE prise ADD lieu VARCHAR(100) NOT NULL, DROP spot_id');
    }
}
