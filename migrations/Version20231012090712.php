<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231012090712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D88926229D86650F');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622B2E00B12');
        $this->addSql('DROP INDEX IDX_D88926229D86650F ON rating');
        $this->addSql('DROP INDEX IDX_D8892622B2E00B12 ON rating');
        $this->addSql('ALTER TABLE rating ADD user_id INT NOT NULL, ADD music_id INT NOT NULL, DROP user_id_id, DROP song_id_id, CHANGE creating_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622399BBB13 FOREIGN KEY (music_id) REFERENCES music (id)');
        $this->addSql('CREATE INDEX IDX_D8892622A76ED395 ON rating (user_id)');
        $this->addSql('CREATE INDEX IDX_D8892622399BBB13 ON rating (music_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622399BBB13');
        $this->addSql('DROP INDEX IDX_D8892622A76ED395 ON rating');
        $this->addSql('DROP INDEX IDX_D8892622399BBB13 ON rating');
        $this->addSql('ALTER TABLE rating ADD user_id_id INT NOT NULL, ADD song_id_id INT NOT NULL, DROP user_id, DROP music_id, CHANGE created_at creating_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926229D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622B2E00B12 FOREIGN KEY (song_id_id) REFERENCES music (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D88926229D86650F ON rating (user_id_id)');
        $this->addSql('CREATE INDEX IDX_D8892622B2E00B12 ON rating (song_id_id)');
    }
}
