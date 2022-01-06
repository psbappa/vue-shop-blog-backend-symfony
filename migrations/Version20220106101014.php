<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106101014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE color_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE color (id INT NOT NULL, name VARCHAR(255) NOT NULL, hex_color VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) NOT NULL, weight DOUBLE PRECISION DEFAULT NULL, price INT DEFAULT NULL, stock_quantity INT DEFAULT NULL, image_filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE TABLE product_color (product_id INT NOT NULL, color_id INT NOT NULL, PRIMARY KEY(product_id, color_id))');
        $this->addSql('CREATE INDEX IDX_C70A33B54584665A ON product_color (product_id)');
        $this->addSql('CREATE INDEX IDX_C70A33B57ADA1FB5 ON product_color (color_id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B54584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B57ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product_color DROP CONSTRAINT FK_C70A33B57ADA1FB5');
        $this->addSql('ALTER TABLE product_color DROP CONSTRAINT FK_C70A33B54584665A');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE color_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_color');
    }
}
