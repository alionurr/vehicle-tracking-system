<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230725204308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repair_place (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, monthly_capacity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repair_place_repair_type (repair_place_id INT NOT NULL, repair_type_id INT NOT NULL, INDEX IDX_713F3B2E643EDBB2 (repair_place_id), INDEX IDX_713F3B2E5BF7D900 (repair_type_id), PRIMARY KEY(repair_place_id, repair_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repair_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_info (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, vehicle_brand_id INT NOT NULL, vehicle_model_id INT NOT NULL, repair_type_id INT NOT NULL, repair_place_id INT NOT NULL, repair_date DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5CA85BB9395C3F3 (customer_id), INDEX IDX_5CA85BB99E7DF9C (vehicle_brand_id), INDEX IDX_5CA85BBA467B873 (vehicle_model_id), INDEX IDX_5CA85BB5BF7D900 (repair_type_id), INDEX IDX_5CA85BB643EDBB2 (repair_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_model (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, name VARCHAR(255) NOT NULL, segment VARCHAR(255) NOT NULL, INDEX IDX_B53AF23544F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE repair_place_repair_type ADD CONSTRAINT FK_713F3B2E643EDBB2 FOREIGN KEY (repair_place_id) REFERENCES repair_place (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE repair_place_repair_type ADD CONSTRAINT FK_713F3B2E5BF7D900 FOREIGN KEY (repair_type_id) REFERENCES repair_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_info ADD CONSTRAINT FK_5CA85BB9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE service_info ADD CONSTRAINT FK_5CA85BB99E7DF9C FOREIGN KEY (vehicle_brand_id) REFERENCES vehicle_brand (id)');
        $this->addSql('ALTER TABLE service_info ADD CONSTRAINT FK_5CA85BBA467B873 FOREIGN KEY (vehicle_model_id) REFERENCES vehicle_model (id)');
        $this->addSql('ALTER TABLE service_info ADD CONSTRAINT FK_5CA85BB5BF7D900 FOREIGN KEY (repair_type_id) REFERENCES repair_type (id)');
        $this->addSql('ALTER TABLE service_info ADD CONSTRAINT FK_5CA85BB643EDBB2 FOREIGN KEY (repair_place_id) REFERENCES repair_place (id)');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF23544F5D008 FOREIGN KEY (brand_id) REFERENCES vehicle_brand (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repair_place_repair_type DROP FOREIGN KEY FK_713F3B2E643EDBB2');
        $this->addSql('ALTER TABLE repair_place_repair_type DROP FOREIGN KEY FK_713F3B2E5BF7D900');
        $this->addSql('ALTER TABLE service_info DROP FOREIGN KEY FK_5CA85BB9395C3F3');
        $this->addSql('ALTER TABLE service_info DROP FOREIGN KEY FK_5CA85BB99E7DF9C');
        $this->addSql('ALTER TABLE service_info DROP FOREIGN KEY FK_5CA85BBA467B873');
        $this->addSql('ALTER TABLE service_info DROP FOREIGN KEY FK_5CA85BB5BF7D900');
        $this->addSql('ALTER TABLE service_info DROP FOREIGN KEY FK_5CA85BB643EDBB2');
        $this->addSql('ALTER TABLE vehicle_model DROP FOREIGN KEY FK_B53AF23544F5D008');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE repair_place');
        $this->addSql('DROP TABLE repair_place_repair_type');
        $this->addSql('DROP TABLE repair_type');
        $this->addSql('DROP TABLE service_info');
        $this->addSql('DROP TABLE vehicle_brand');
        $this->addSql('DROP TABLE vehicle_model');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
