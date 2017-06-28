<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 27.05.17
 * Time: 19:30
 */

namespace AppBundle\Service;



use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RegistrationService extends Controller
{


    private $connection;
    public function __construct(Connection $dbalConnection)
    {
        $this->connection=$dbalConnection;
    }
/*
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
*/
    public function add_user($name,$surname,$email,$password)
    {
/*
        $user=new User();
        $user->setSurname($surname);
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setIsactive(0);
*/
        $sql='INSERT INTO user(username,surname,email,password,isactive) VALUES (:username,:surname,:email,:password,:isactive)';
        $stmt=$this->connection->prepare($sql);
        $stmt->execute(array(':username'=>$name,':surname'=>$surname,'email'=>$email,':password'=>$password, ':isactive'=>1));

        // $stsm = $this->connection->getRepository(User::class);

        $em = $this->getDoctrine()->getManager();

        $em->flush();
    }
}