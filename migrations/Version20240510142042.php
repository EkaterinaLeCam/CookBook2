<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240510142042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, nom_utilisateur_id INT DEFAULT NULL, date_de_publication DATETIME NOT NULL, texte_commentaire LONGTEXT NOT NULL, INDEX IDX_67F068BCECB301B6 (nom_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, nom_ingredient VARCHAR(100) NOT NULL, quantite INT NOT NULL, mesure VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_plat (id INT AUTO_INCREMENT NOT NULL, nom_utilisateur_id INT DEFAULT NULL, recette_id INT DEFAULT NULL, note INT NOT NULL, INDEX IDX_8042B35FECB301B6 (nom_utilisateur_id), INDEX IDX_8042B35F89312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT DEFAULT NULL, nom_categorie_id INT DEFAULT NULL, commentaires_id INT DEFAULT NULL, nom_recette VARCHAR(255) NOT NULL, preparation LONGTEXT NOT NULL, temps_de_cuisson VARCHAR(20) NOT NULL, temps_de_preparation VARCHAR(30) NOT NULL, difficulte VARCHAR(20) NOT NULL, pays VARCHAR(100) NOT NULL, INDEX IDX_49BB6390933FE08C (ingredient_id), INDEX IDX_49BB639031338A73 (nom_categorie_id), INDEX IDX_49BB639017C4B2B0 (commentaires_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE table_de_reponses (id INT AUTO_INCREMENT NOT NULL, nom_utilisateur_id INT DEFAULT NULL, commentaire_id INT DEFAULT NULL, reponse LONGTEXT NOT NULL, INDEX IDX_598217D7ECB301B6 (nom_utilisateur_id), INDEX IDX_598217D7BA9CD190 (commentaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(70) NOT NULL, prenom VARCHAR(70) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCECB301B6 FOREIGN KEY (nom_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE note_plat ADD CONSTRAINT FK_8042B35FECB301B6 FOREIGN KEY (nom_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE note_plat ADD CONSTRAINT FK_8042B35F89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639031338A73 FOREIGN KEY (nom_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639017C4B2B0 FOREIGN KEY (commentaires_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE table_de_reponses ADD CONSTRAINT FK_598217D7ECB301B6 FOREIGN KEY (nom_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE table_de_reponses ADD CONSTRAINT FK_598217D7BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCECB301B6');
        $this->addSql('ALTER TABLE note_plat DROP FOREIGN KEY FK_8042B35FECB301B6');
        $this->addSql('ALTER TABLE note_plat DROP FOREIGN KEY FK_8042B35F89312FE9');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390933FE08C');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639031338A73');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639017C4B2B0');
        $this->addSql('ALTER TABLE table_de_reponses DROP FOREIGN KEY FK_598217D7ECB301B6');
        $this->addSql('ALTER TABLE table_de_reponses DROP FOREIGN KEY FK_598217D7BA9CD190');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE note_plat');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE table_de_reponses');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
