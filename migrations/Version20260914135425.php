<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260914135425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE track_playlist (track_id INT NOT NULL, playlist_id INT NOT NULL, INDEX IDX_B45DE36C5ED23C43 (track_id), INDEX IDX_B45DE36C6BBD148 (playlist_id), PRIMARY KEY (track_id, playlist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE track_playlist ADD CONSTRAINT FK_B45DE36C5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_playlist ADD CONSTRAINT FK_B45DE36C6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historical ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE historical ADD CONSTRAINT FK_A56FCD03A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_A56FCD03A76ED395 ON historical (user_id)');
        $this->addSql('ALTER TABLE playlist ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_D782112DA76ED395 ON playlist (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE track_playlist DROP FOREIGN KEY FK_B45DE36C5ED23C43');
        $this->addSql('ALTER TABLE track_playlist DROP FOREIGN KEY FK_B45DE36C6BBD148');
        $this->addSql('DROP TABLE track_playlist');
        $this->addSql('ALTER TABLE historical DROP FOREIGN KEY FK_A56FCD03A76ED395');
        $this->addSql('DROP INDEX IDX_A56FCD03A76ED395 ON historical');
        $this->addSql('ALTER TABLE historical DROP user_id');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112DA76ED395');
        $this->addSql('DROP INDEX IDX_D782112DA76ED395 ON playlist');
        $this->addSql('ALTER TABLE playlist DROP user_id');
    }
}
