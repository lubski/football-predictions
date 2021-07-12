<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706152633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE prediction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TYPE enum_status AS ENUM (\'win\', \'lost\', \'unresolved\')');
        $this->addSql('CREATE TYPE enum_market_type AS ENUM (\'1x2\', \'correct_score\')');
        $this->addSql('CREATE TABLE prediction (id INT NOT NULL, event_id INT NOT NULL, market_type enum_market_type NOT NULL, prediction VARCHAR(3) NOT NULL, status enum_status DEFAULT \'unresolved\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN prediction.market_type IS \'(DC2Type:enum_market_type)\'');
        $this->addSql('COMMENT ON COLUMN prediction.status IS \'(DC2Type:enum_status)\'');
        $this->addSql('COMMENT ON COLUMN prediction.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE prediction_id_seq CASCADE');
        $this->addSql('DROP TABLE prediction');
    }
}
