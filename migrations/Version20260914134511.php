<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260914134511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE track_genre (track_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_F3A7915F5ED23C43 (track_id), INDEX IDX_F3A7915F4296D31F (genre_id), PRIMARY KEY (track_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE track_genre ADD CONSTRAINT FK_F3A7915F5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_genre ADD CONSTRAINT FK_F3A7915F4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite ADD track_id INT NOT NULL');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED95ED23C43 FOREIGN KEY (track_id) REFERENCES track (id)');
        $this->addSql('CREATE INDEX IDX_68C58ED95ED23C43 ON favorite (track_id)');
        $this->addSql('ALTER TABLE historical ADD track_id INT NOT NULL');
        $this->addSql('ALTER TABLE historical ADD CONSTRAINT FK_A56FCD035ED23C43 FOREIGN KEY (track_id) REFERENCES track (id)');
        $this->addSql('CREATE INDEX IDX_A56FCD035ED23C43 ON historical (track_id)');
        $this->addSql('ALTER TABLE track ADD album_id INT DEFAULT NULL, ADD artist_id INT NOT NULL');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A61137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A6B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_D6E3F8A61137ABCF ON track (album_id)');
        $this->addSql('CREATE INDEX IDX_D6E3F8A6B7970CF8 ON track (artist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE track_genre DROP FOREIGN KEY FK_F3A7915F5ED23C43');
        $this->addSql('ALTER TABLE track_genre DROP FOREIGN KEY FK_F3A7915F4296D31F');
        $this->addSql('DROP TABLE track_genre');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED95ED23C43');
        $this->addSql('DROP INDEX IDX_68C58ED95ED23C43 ON favorite');
        $this->addSql('ALTER TABLE favorite DROP track_id');
        $this->addSql('ALTER TABLE historical DROP FOREIGN KEY FK_A56FCD035ED23C43');
        $this->addSql('DROP INDEX IDX_A56FCD035ED23C43 ON historical');
        $this->addSql('ALTER TABLE historical DROP track_id');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A61137ABCF');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A6B7970CF8');
        $this->addSql('DROP INDEX IDX_D6E3F8A61137ABCF ON track');
        $this->addSql('DROP INDEX IDX_D6E3F8A6B7970CF8 ON track');
        $this->addSql('ALTER TABLE track DROP album_id, DROP artist_id');
    }
}
