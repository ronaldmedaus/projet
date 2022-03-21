<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220321141445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color_purchase (color_id INT NOT NULL, purchase_id INT NOT NULL, INDEX IDX_BD924A797ADA1FB5 (color_id), INDEX IDX_BD924A79558FBEB9 (purchase_id), PRIMARY KEY(color_id, purchase_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, user_id INT NOT NULL, status VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9474526C4B89032C (post_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `condition` (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_invoice (id INT AUTO_INCREMENT NOT NULL, invoice_id INT NOT NULL, product_name VARCHAR(100) NOT NULL, price_product INT NOT NULL, image_product VARCHAR(255) NOT NULL, quantity INT NOT NULL, INDEX IDX_4F6DCEF72989F1FD (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_list_product (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, purchase_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_B8DD51F4584665A (product_id), INDEX IDX_B8DD51F558FBEB9 (purchase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, purchase_id INT NOT NULL, is_paid TINYINT(1) NOT NULL, total INT NOT NULL, UNIQUE INDEX UNIQ_90651744558FBEB9 (purchase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_product (id INT AUTO_INCREMENT NOT NULL, purchase_id INT NOT NULL, list_product_id INT NOT NULL, INDEX IDX_F05D9A0558FBEB9 (purchase_id), UNIQUE INDEX UNIQ_F05D9A09FA91286 (list_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, image_path VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(100) NOT NULL, price INT NOT NULL, image_path VARCHAR(255) NOT NULL, style VARCHAR(100) NOT NULL, season VARCHAR(100) NOT NULL, color VARCHAR(100) NOT NULL, size VARCHAR(255) NOT NULL, quantity VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_size (id INT AUTO_INCREMENT NOT NULL, is_27 TINYINT(1) NOT NULL, is_28 TINYINT(1) NOT NULL, is_29 TINYINT(1) NOT NULL, is_30 TINYINT(1) NOT NULL, is_31 TINYINT(1) NOT NULL, is_32 TINYINT(1) NOT NULL, is_33 TINYINT(1) NOT NULL, is_34 TINYINT(1) NOT NULL, is_35 TINYINT(1) NOT NULL, is_36 TINYINT(1) NOT NULL, is_37 TINYINT(1) NOT NULL, is_38 TINYINT(1) NOT NULL, is_39 TINYINT(1) NOT NULL, is_40 TINYINT(1) NOT NULL, is_41 TINYINT(1) NOT NULL, is_42 TINYINT(1) NOT NULL, is_43 TINYINT(1) NOT NULL, is_44 TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_size_product (product_size_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_BB83F4BE9854B397 (product_size_id), INDEX IDX_BB83F4BE4584665A (product_id), PRIMARY KEY(product_size_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, country VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, telephone VARCHAR(10) NOT NULL, INDEX IDX_6117D13BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, image_path VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE color_purchase ADD CONSTRAINT FK_BD924A797ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE color_purchase ADD CONSTRAINT FK_BD924A79558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE content_invoice ADD CONSTRAINT FK_4F6DCEF72989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE content_list_product ADD CONSTRAINT FK_B8DD51F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE content_list_product ADD CONSTRAINT FK_B8DD51F558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id)');
        $this->addSql('ALTER TABLE list_product ADD CONSTRAINT FK_F05D9A0558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id)');
        $this->addSql('ALTER TABLE list_product ADD CONSTRAINT FK_F05D9A09FA91286 FOREIGN KEY (list_product_id) REFERENCES list_product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product_size_product ADD CONSTRAINT FK_BB83F4BE9854B397 FOREIGN KEY (product_size_id) REFERENCES product_size (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_size_product ADD CONSTRAINT FK_BB83F4BE4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE color_purchase DROP FOREIGN KEY FK_BD924A797ADA1FB5');
        $this->addSql('ALTER TABLE content_invoice DROP FOREIGN KEY FK_4F6DCEF72989F1FD');
        $this->addSql('ALTER TABLE list_product DROP FOREIGN KEY FK_F05D9A09FA91286');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE content_list_product DROP FOREIGN KEY FK_B8DD51F4584665A');
        $this->addSql('ALTER TABLE product_size_product DROP FOREIGN KEY FK_BB83F4BE4584665A');
        $this->addSql('ALTER TABLE product_size_product DROP FOREIGN KEY FK_BB83F4BE9854B397');
        $this->addSql('ALTER TABLE color_purchase DROP FOREIGN KEY FK_BD924A79558FBEB9');
        $this->addSql('ALTER TABLE content_list_product DROP FOREIGN KEY FK_B8DD51F558FBEB9');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744558FBEB9');
        $this->addSql('ALTER TABLE list_product DROP FOREIGN KEY FK_F05D9A0558FBEB9');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE color_purchase');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE `condition`');
        $this->addSql('DROP TABLE content_invoice');
        $this->addSql('DROP TABLE content_list_product');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE list_product');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_size');
        $this->addSql('DROP TABLE product_size_product');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
    }
}
