<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 23.05.17
 * Time: 11:21
 */

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class savecsvCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('save:database')
            ->setDescription('Export Data to a file in CSV format')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you wand to greet?'
            )
        ;
    }
    protected function execute(InputInterface $input,OutputInterface $output)
    {


        $name=$input->getArgument('name');
        //połączenie z bazą danych
        $db_conn=$this->getContainer()->get('database_connection');
        if($db_conn)
        {
            $output->writeln('Połączono z bazą danych');
        }

        $stmt = $db_conn->query('SELECT * FROM ingredients');


        $fp = fopen('file.csv', 'w');

        while($row = $stmt->fetch())
        {
            fputcsv($fp,array($row['id'],$row['name_ingredient'],$row['recipes_id']));
         /*   $output->writeln('id: ' . $row['id']  .
                ', nazwa:' . $row['name_ingredient']  .
                ', id przepisu:' . $row['recipes_id']
            );
         */
        }
        fclose($fp);
        $output->writeln("dodano");
    }
}