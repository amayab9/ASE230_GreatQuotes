<?php
session_start();

        $fh = fopen('../data/authors.csv', 'r');
        $line_counter=0;
        while($line=fgets($fh)){
          if($line_counter==$_GET['index']){
            $_SESSION['authorLineNumber'] = $line_counter; // to pull index of author for quotes
            //display the author
            echo $line;
          }
          $line_counter++;
        }
        fclose($fh);
?>
<a href='../quotes/create.php' >Add a quote</a>
<a href="modify.php?index=<?= $_GET['index'] ?>">modify author</a>
<a href="delete.php?index=<?= $_GET['index'] ?>">delete author</a>
<p> Quotes: </p>

<?php
#check for index of the author
#read the file
#if the index of the author matches to the index of the author in the quotes.csv file then print that quote
  $fh = fopen('../data/quotes.csv', 'r');
  $line_counter = 0;
  while($line=fgets($fh)){
    if($line_counter==$_GET['index'] && $line_counter== $_SESSION['authorLineNumber']){//if index of author matches the index on this page
      $line=trim($line);
      $line=explode(';', $line);
      if($line[1]==trim($_SESSION['authorLineNumber'])){
        echo $line;
      }
    }
    $line_counter++;
  }
  fclose($fh);
