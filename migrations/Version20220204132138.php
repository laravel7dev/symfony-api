<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204132138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, locale_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5373C966E559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locale (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, iso VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_group_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_D34A04AD35E4B3D0 (product_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vat (id INT AUTO_INCREMENT NOT NULL, product_group_id INT NOT NULL, locale_id INT NOT NULL, name VARCHAR(255) NOT NULL, value INT NOT NULL, INDEX IDX_84B3223335E4B3D0 (product_group_id), INDEX IDX_84B32233E559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD35E4B3D0 FOREIGN KEY (product_group_id) REFERENCES product_group (id)');
        $this->addSql('ALTER TABLE vat ADD CONSTRAINT FK_84B3223335E4B3D0 FOREIGN KEY (product_group_id) REFERENCES product_group (id)');
        $this->addSql('ALTER TABLE vat ADD CONSTRAINT FK_84B32233E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966E559DFD1');
        $this->addSql('ALTER TABLE vat DROP FOREIGN KEY FK_84B32233E559DFD1');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD35E4B3D0');
        $this->addSql('ALTER TABLE vat DROP FOREIGN KEY FK_84B3223335E4B3D0');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE locale');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_group');
        $this->addSql('DROP TABLE vat');
    }
}
