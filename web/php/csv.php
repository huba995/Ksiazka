<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 22.05.17
 * Time: 10:11
 */


if (($uchwyt = fopen ("test.csv","r")) !== FALSE) {
    while (($data = fgetcsv($uchwyt, 1000, ",")) !== FALSE)  {
       // $num = count($data);
       // echo "<p> $num pól w lini $row: <br /></p>\n";
       // $row++;

        $created_add=new \DateTime("now");
        $created_add=$created_add->format('Y-m-d H:i:s');

        $db_conn=new \PDO('mysql:host=localhost;dbname=menu','root','Huba1995');
        // dodaje rekord do bazy
        $sql='INSERT INTO recipes(name_recipe,description,created_add,mydisplay,plus,minus) VALUES (:name_recipe,:description,:created_add,:mydisplay,:plus,:minus)';
        $stmt=$db_conn->prepare($sql);
        $stmt->execute(array(':name_recipe'=>$data[0],':description'=>$data[1],'created_add'=>$created_add,':mydisplay'=>$data[3],':plus'=>$data[4],':minus'=>$data[5]));


/*
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
  */
    }
    fclose ($uchwyt);
}
echo "hello";