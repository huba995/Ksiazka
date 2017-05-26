<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 26.05.17
 * Time: 14:21
 */

namespace AppBundle\Service;




use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RateRecipe extends Controller
{
    private $connection;
    public function __construct(Connection $dbalConnection)
    {
        $this->connection=$dbalConnection;
    }
    public function lookSomething($foo)
    {

        $sql = "SELECT * FROM recipes WHERE id = :foo";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue("foo", $foo);
        $stmt->execute();
        $recipe=$stmt->fetch();

        return $recipe['name_recipe'];
    }
    public function change_minus($id)
    {
        $sql="UPDATE recipes SET minus=minus+1 WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue("id", $id);
        $stmt->execute();
    }
    public function change_plus($id)
    {
        $sql="UPDATE recipes SET plus=plus+1 WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue("id", $id);
        $stmt->execute();
    }

}