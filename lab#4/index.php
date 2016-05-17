<?php 
        $dbhost = 'localhost:3036';
        $dbuser = 'lemax';
        $dbpass = '';
        $conn = mysql_connect($dbhost, $dbuser, $dbpass);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Workin on database</title>
</head>
<style type="text/css">
    .insert { 
        margin: 0 auto;
        width: 400px;
    }
    .insert label {
        display: block;
        overflow: hidden;
        margin-bottom:15px;
    }
    
    .insert input {
        float:right;
    }
    
    h2{ text-align: center; }
    
    b { 
        display: inline-block;
        float: left; 
    }
    
    form {
      overflow:hidden;  
      
    }
    .update {
        width: 751px;
        margin: 0 auto;
    }
    
    .update input { width: 100px; }
    .update input:last-child {float: right;}
</style>
<body>
        <?php 
    
        // Проверка соеденения       
        if(! $conn ) {
            die('Could not connect: ' . mysql_error());
        }
        
        // Select database
        mysql_select_db('lab_1');
        
        // Get values from form    
        $name = $_POST['name'];
        $prenume = $_POST['prenume'];
        $birthday = $_POST['birthday'];
        $faculty = $_POST['faculty'];
        $course = $_POST['course'];
        
        
        // Insert data into mysql    
        if (isset($_POST['submit'])) {
            $sql = "INSERT INTO studenti" . 
            "(name, prenume, birthdate, faculty, course)" .
            "VALUES('$name', '$prenume', '$birthday', '$faculty', '$course')";
            $result = mysql_query( $sql, $conn);
        
            if(! $result ) {
                die('Could not enter data: ' . mysql_error());
            }
            echo "Entered data successfully\n";
        }
       
    ?>
    
    <!-- inserting data -->
    <form class="insert" method="POST" action="<?php $_PHP_SELF ?>">
        <h2>Introducerea datelor in baza:</h2>
        <label for="">Nume: <input type="text" name="name"/></label>
        
        <label for="">Prenume: <input type="text" name="prenume"/></label>
        
        <label for="">An. Nasterii: <input type="text" name="birthday"/></label>
        
        <label for="">Facultatea: <input type="text" name="faculty"/></label>
        
        <label for="">Cursul: <input type="text" name="course"/></label>
        
        <input type="submit" value="Submit" name="submit"/>
    </form>
    <br>
    
    <h2>Update la date din tabel</h2> 
    <form class="update" method="GET" action="<?php $_PHP_SELF ?>">
        <table align="center">
            <tr>
                <td><b>ID:</b></td>
                <td><b>Name:</b></td>
                <td><b>Surname:</b></td>
                <td><b>Birth:</b></td>
                <td><b>Faculty:</b></td>
                <td><b>Course:</b></td>
            </tr>
    <?php 

        // Проверка соеденения       
        if(! $conn ) {
            die('Could not connect: ' . mysql_error());
        }
        
        $sql = 'SELECT id, name, prenume, birthdate, faculty, course FROM studenti';
        mysql_select_db('lab_1');
        
        $result = mysql_query($sql, $conn);
        
        // condition for result
        if (!$result) {
            die('Could not get data: ' . mysql_error());
        }
        
        
        // Show all entries from db
        while($row = mysql_fetch_array($result, MYSQL_NUM)){
            echo "      
                    <tr>".
                        "<td><input type=\"text\" name=\"id\" value=\"{$row[0]}\"/></td>".
                        "<td><input type=\"text\" name=\"name\" value=\"{$row[1]}\"/></td>".
                        "<td><input type=\"text\" name=\"prenume\" value=\"{$row[2]}\"/></td>".
                        "<td><input type=\"text\" name=\"birthdate\" value=\"{$row[3]}\"/></td>".
                        "<td><input type=\"text\" name=\"faculty\" value=\"{$row[4]}\"/></td>".
                        "<td><input type=\"text\" name=\"course\" value=\"{$row[5]}\"/></td>".
                        "<td><input type=\"submit\" name=\"remove\" value=\"remove\"/></td>
                    </tr>";    

        }
        
        $id = $_GET['id'];
        $name = $_GET['name'];
        $surname = $_GET['prenume'];
        $birthday = $_GET['birthdate'];
        $faculty = $_GET['faculty'];
        $course = $_GET['course'];
        
        
        // Do action when is actioned button update
        if ( isset($_GET['update']) ) {
           $sql = "UPDATE studenti SET name = '$name', prenume = '$surname', 
                          birthdate = '$birthday', faculty = '$faculty', course = '$course'
                   WHERE id = '$id'";
            $result = mysql_query($sql, $conn);
            
            if(! $result ) {
                die('Could not enter data: ' . mysql_error());
            }
            echo "Entered data successfully\n";
        }

        
        // Do action when is actioned button 'remove'
        if ( isset($_GET['remove'])) {
            $sql = "DELETE FROM studenti 
                    WHERE id = '$id'";
            $result = mysql_query($sql, $conn);
            
            if(! $result ) {
                die('Could not delete data: ' . mysql_error());
            }
            echo "Deleted data successfully\n";
        }
        
        mysql_close($conn);
    ?>
        </table>
        <input type="submit" value="Update" name="update"/> 
    </form>
    

 

</body>
</html>



