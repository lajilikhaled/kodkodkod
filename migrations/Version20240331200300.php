<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240331200300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD image VARCHAR(255) DEFAULT NULL, ADD slide_one_image_right VARCHAR(255) DEFAULT NULL, ADD slide_one_image_center VARCHAR(255) DEFAULT NULL, ADD slide_one_image_left VARCHAR(255) DEFAULT NULL, ADD slide_two_image_left VARCHAR(255) DEFAULT NULL, ADD slide_two_image_right VARCHAR(255) DEFAULT NULL, ADD slide_three_image1_left VARCHAR(255) DEFAULT NULL, ADD slide_three_image2_right VARCHAR(255) DEFAULT NULL, ADD slide_three_image3_left VARCHAR(255) DEFAULT NULL, ADD slide_three_image4_right VARCHAR(255) DEFAULT NULL, DROP images');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD images LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', DROP image, DROP slide_one_image_right, DROP slide_one_image_center, DROP slide_one_image_left, DROP slide_two_image_left, DROP slide_two_image_right, DROP slide_three_image1_left, DROP slide_three_image2_right, DROP slide_three_image3_left, DROP slide_three_image4_right');
    }
}
