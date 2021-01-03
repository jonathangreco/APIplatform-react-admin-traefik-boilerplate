<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210102203048 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE usr_role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL COMMENT \'Name of the role\', description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usr_users (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL COMMENT \'Because anything is created at a moment\', deleted DATETIME DEFAULT NULL COMMENT \'If null it\'\'s active, if it\'\'s filled and passed, it\'\'s not\', email VARCHAR(150) DEFAULT NULL COMMENT \'If null it\'\'s active, if it\'\'s filled and passed, it\'\'s not\', username VARCHAR(40) DEFAULT NULL COMMENT \'Username\', hashed_password VARCHAR(64) NOT NULL COMMENT \'Password - self documented\', locale VARCHAR(2) DEFAULT NULL COMMENT \'Locale of the user, defined in user\'\'s preferences\', reset_token VARCHAR(64) DEFAULT NULL COMMENT \'Reset password token\', timezone VARCHAR(255) DEFAULT \'Europe/Paris\' COMMENT \'Timezone of the user, defined in user\'\'s preferences default to Europe/Paris\', UNIQUE INDEX UNIQ_2A6C2D93E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usr_users_groups (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_FF0171ACA76ED395 (user_id), INDEX IDX_FF0171ACFE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usr_users_groups ADD CONSTRAINT FK_FF0171ACA76ED395 FOREIGN KEY (user_id) REFERENCES usr_users (id)');
        $this->addSql('ALTER TABLE usr_users_groups ADD CONSTRAINT FK_FF0171ACFE54D947 FOREIGN KEY (group_id) REFERENCES usr_role (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usr_users_groups DROP FOREIGN KEY FK_FF0171ACFE54D947');
        $this->addSql('ALTER TABLE usr_users_groups DROP FOREIGN KEY FK_FF0171ACA76ED395');
        $this->addSql('DROP TABLE usr_role');
        $this->addSql('DROP TABLE usr_users');
        $this->addSql('DROP TABLE usr_users_groups');
    }
}
