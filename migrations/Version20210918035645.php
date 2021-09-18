<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210918035645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collectible (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, width INT DEFAULT NULL, height INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE market (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, collection VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6BAC85CB126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, default_order INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, uid VARCHAR(255) NOT NULL, phase_seed VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_collectible (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, collectible_id INT NOT NULL, UNIQUE INDEX UNIQ_B4045EFBA76ED395 (user_id), UNIQUE INDEX UNIQ_B4045EFB9700322F (collectible_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_market (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, market_id INT NOT NULL, UNIQUE INDEX UNIQ_EFE9EF6A76ED395 (user_id), UNIQUE INDEX UNIQ_EFE9EF6622F3F37 (market_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_mission (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, mission_id INT NOT NULL, UNIQUE INDEX UNIQ_C86AEC36A76ED395 (user_id), UNIQUE INDEX UNIQ_C86AEC36BE6CAE90 (mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE market ADD CONSTRAINT FK_6BAC85CB126F525E FOREIGN KEY (item_id) REFERENCES collectible (id)');
        $this->addSql('ALTER TABLE user_collectible ADD CONSTRAINT FK_B4045EFBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_collectible ADD CONSTRAINT FK_B4045EFB9700322F FOREIGN KEY (collectible_id) REFERENCES collectible (id)');
        $this->addSql('ALTER TABLE user_market ADD CONSTRAINT FK_EFE9EF6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_market ADD CONSTRAINT FK_EFE9EF6622F3F37 FOREIGN KEY (market_id) REFERENCES market (id)');
        $this->addSql('ALTER TABLE user_mission ADD CONSTRAINT FK_C86AEC36A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_mission ADD CONSTRAINT FK_C86AEC36BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE market DROP FOREIGN KEY FK_6BAC85CB126F525E');
        $this->addSql('ALTER TABLE user_collectible DROP FOREIGN KEY FK_B4045EFB9700322F');
        $this->addSql('ALTER TABLE user_market DROP FOREIGN KEY FK_EFE9EF6622F3F37');
        $this->addSql('ALTER TABLE user_mission DROP FOREIGN KEY FK_C86AEC36BE6CAE90');
        $this->addSql('ALTER TABLE user_collectible DROP FOREIGN KEY FK_B4045EFBA76ED395');
        $this->addSql('ALTER TABLE user_market DROP FOREIGN KEY FK_EFE9EF6A76ED395');
        $this->addSql('ALTER TABLE user_mission DROP FOREIGN KEY FK_C86AEC36A76ED395');
        $this->addSql('DROP TABLE collectible');
        $this->addSql('DROP TABLE market');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_collectible');
        $this->addSql('DROP TABLE user_market');
        $this->addSql('DROP TABLE user_mission');
    }
}
