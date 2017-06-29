<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170628125851 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    $users= array(
                array('name'=>'Hubert'),
                array('name'=>'Władysław'),
                array('name'=>'Sebastian'),
    );

    foreach($users as $user)
    {
        $this->addSql('UPDATE user SET isactive = true WHERE username = :name', $user);
    }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $users= array(
            array('name'=>'Hubert'),
            array('name'=>'Władysław'),
            array('name'=>'Sebastian'),
        );

        foreach($users as $user)
        {
            $this->addSql('UPDATE user SET isactive = false WHERE username = :name', $user);
        }
    }
}
