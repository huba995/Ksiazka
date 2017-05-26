<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 23.05.17
 * Time: 10:05
 */

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;

class csvCommand extends ContainerAwareCommand
{
    /*
    private $csvPars=array(
        'finder_in'=>'web/php/',
        'finder_name'=>'test.csv'
        'ignoreFirstLine' => true
    );
    */
    protected function configure()
    {
        $this
            ->setName('add:csv')
            ->setDescription('Read csv')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Who do you wand to greet?'
            )
        ;

    }

    protected function execute(InputInterface $input,OutputInterface $output)
    {
        //odczytuje ścieżke do folderu app
        $name=$this->getContainer()->getParameter('kernel.root_dir');
        //doklejam ścieżke poniżej folderu app aby uzyskac dostęp do pliku
        $name.=$input->getArgument('name');
        //połączenie z bazą danych
        $db_conn=$this->getContainer()->get('database_connection');
        if($db_conn)
        {
            $output->writeln('Połączono z bazą danych');
        }

        if (($uchwyt = fopen ($name,"r")) !== FALSE) {
            while (($data = fgetcsv($uchwyt, 1000, ",")) !== FALSE)  {

                $created_add=new \DateTime("now");
                $created_add=$created_add->format('Y-m-d H:i:s');

                // dodaje rekord do bazy
                $sql='INSERT INTO recipes(name_recipe,description,created_add,mydisplay,plus,minus) VALUES (:name_recipe,:description,:created_add,:mydisplay,:plus,:minus)';
                $stmt=$db_conn->prepare($sql);
                $stmt->execute(array(':name_recipe'=>$data[0],':description'=>$data[1],'created_add'=>$created_add,':mydisplay'=>$data[3],':plus'=>$data[4],':minus'=>$data[5]));

            }
            fclose ($uchwyt);
        }
        $output->writeln("dodano");
    }
}