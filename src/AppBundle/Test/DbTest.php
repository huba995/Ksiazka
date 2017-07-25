<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 02.07.17
 * Time: 17:34
 */

namespace AppBundle\Test;


use Doctrine\DBAL\Connection;
use PHPUnit\ExampleExtension\TestCaseTrait;
use PHPUnit\Framework\TestCase;


class DbTest extends TestCase
{
    use TestCaseTrait;

    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection(Connection $dbalConnection)
    {
        $this->connection=$dbalConnection;


        $pdo = new \PDO('sqlite::memory:');
        return $this->createDefaultDBConnection($pdo, ':memory:');

    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__).'/_files/guestbook-seed.xml');
    }
}