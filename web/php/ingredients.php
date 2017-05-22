<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 22.05.17
 * Time: 21:49
 */

if (($uchwyt = fopen ("ingredients.csv","r")) !== FALSE) {
    while (($data = fgetcsv($uchwyt, 1000, ",")) !== FALSE)  {
        // $num = count($data);
        // echo "<p> $num pól w lini $row: <br /></p>\n";
        // $row++;

        $db_conn=new \PDO('mysql:host=localhost;dbname=menu','root','Huba1995');
        // dodaje rekord do bazy
        $sql='INSERT INTO ingredients(name_ingredient,recipes_id) VALUES (:name_ingredient,:recipes_id)';
        $stmt=$db_conn->prepare($sql);
        $stmt->execute(array(':name_ingredient'=>$data[0],':recipes_id'=>$data[1]));


        /*
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . "<br />\n";
                }
          */
    }
    fclose ($uchwyt);
}
echo "hello";