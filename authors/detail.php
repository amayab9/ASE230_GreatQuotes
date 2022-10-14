<?php
        $fh = fopen('../data/authors.csv', 'r');
        $line_counter=0;
        while($line=fgets($fh)){
          if($line_counter==$_GET['index']){
            //display the author
            echo $line;
          }
          $line_counter++;
        }
        fclose($fh);
?>

<a class="btn btn-secondary" href="modify.php?index=<?= $_GET['index'] ?>">modify author</a>
<a class="btn btn-danger" href="delete.php?index=<?= $_GET['index'] ?>">delete author</a>