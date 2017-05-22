<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 22.05.17
 * Time: 19:55
 */

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RecipeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('add:recipe')
            ->setDescription('Add recipe')
            ->addArgument('name_recipe', InputArgument::REQUIRED, 'Name your recipe')
            ->addArgument('mydisplay', InputArgument::REQUIRED, 'diplay or not (1 or 0)')
            ->addArgument('plus', InputArgument::REQUIRED, 'Rate plus')
            ->addArgument('minus', InputArgument::REQUIRED, 'Rate minus')
            ->addArgument('description', InputArgument::IS_ARRAY, 'Your description')
        ;
    }
    protected function execute(InputInterface $input,OutputInterface $output)
    {
        $name_recipe=$input->getArgument('name_recipe');
        $description=$input->getArgument('description');
        if(count($description)>0)
        {
            $description_=' '.implode(' ',$description);
        }
        $mydisplay=$input->getArgument('mydisplay');
        $plus=$input->getArgument('plus');
        $minus=$input->getArgument('minus');
        //$created_add='2017-22-05 20:45:52';
        $created_add=new \DateTime("now");
        $created_add=$created_add->format('Y-m-d H:i:s');
        $output->writeln('Jestem tutaj');
        if($name_recipe){

            $db_conn=new \PDO('mysql:host=localhost;dbname=menu','root','Huba1995');
            // dodaje rekord do bazy
            $sql='INSERT INTO recipes(name_recipe,description,created_add,mydisplay,plus,minus) VALUES (:name_recipe,:description,:created_add,:mydisplay,:plus,:minus)';
            $stmt=$db_conn->prepare($sql);
            $stmt->execute(array(':name_recipe'=>$name_recipe,':description'=>$description_,'created_add'=>$created_add,':mydisplay'=>$mydisplay,':plus'=>$plus,':minus'=>$minus));

            $text='Add recipes '.$name_recipe;
        }else{
            $text='Hello';
        }

        $output->writeln($text);
    }
}