<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 22.05.17
 * Time: 13:53
 */

namespace AppBundle\Command;


use AppBundle\Entity\Ingredients;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GreetCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('demo:greet')
            ->setDescription('Greet someone')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Who do you wand to greet?'
            )
            ->addArgument('id', InputArgument::REQUIRED, 'Your id?')
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will yell in uppercase letters'
            )
            ;
    }

    protected function execute(InputInterface $input,OutputInterface $output)
    {
        $name=$input->getArgument('name');
        $id=$input->getArgument('id');


        if($name){
            $ingredient=$name;
          $db_conn=new \PDO('mysql:host=localhost;dbname=menu','root','Huba1995');
            // dodaje rekord do bazy
            $sql='INSERT INTO ingredients(name_ingredient,recipes_id) VALUES (:name_ingredient,:recipes_id)';
            $stmt=$db_conn->prepare($sql);
            $stmt->execute(array(':name_ingredient'=>$name,':recipes_id'=>$id));
           // $db_conn->query("INSERT INTO ingredients SET name_ingredient='$ingredient', email='$email'");

            $text='Hello'.$name;
        }else{
            $text='Hello';
        }

        if($input->getOption('yell')){
            $text=strtoupper($text);
        }
        $output->writeln($text);
    }
}