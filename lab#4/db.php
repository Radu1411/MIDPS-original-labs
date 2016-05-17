<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connecting to a database</title>
</head>
<body>
    <?php 
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $conn = mysql_connect($dbhost, $dbuser, $dbpass);
        
        if ( ! $conn) {
            die("Could not connect: " .mysql_error());
        }
        echo "Connected successfully<br>";
        
       
        // Создаём базу данных
        $sql = 'CREATE Database lab_1';
        $retval = mysql_query($sql, $conn);
        
        
        // Проверка на создание базу данных
        if (! $retval ) {
            die('Could not connect: ' .mysql_error());
        }
        echo "Database successfully created";
        mysql_close($conn);*/

    
/*    
    // Создаю таблицу
    $sql = 'CREATE TABLE studenti(' .
        'id INT NOT NULL AUTO_INCREMENT, ' .
        'name VARCHAR(20) NOT NULL, ' .
        'prenume VARCHAR(20) NOT NULL, ' .
        'birthdate VARCHAR(20) NOT NULL, ' .
        'faculty VARCHAR(20) NOT NULL, ' .
        'course INT NOT NULL, ' .
        'primary key (id))';
        
    mysql_select_db('lab_1');
    $retval = mysql_query($sql, $conn);
    
    // Проверка если таблица создана
    if (! $retval) {
        die('Could not create table: ' .mysql_error());
    }
    echo "Table studenti was created";
*/

    
    mysql_close($conn);
    ?>
</body>
</html>