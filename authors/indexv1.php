<h2><a href="create.php">Add a new author</a><hr /></h2>
  <?php
    $fh = fopen('../data/authors.csv', 'r'); //open authors page in read mode
    $index=0;
    while($line=fgets($fh)){
      if(strlen(trim($line))>0) {
        // links to page, but has browser repeat search on the linked page
        echo '<h1><a href="detail.php?index='.$index.'">'.trim($line).'</a>
        (<a href="detail.php?index='.$index.'">view author</a>)
        (<a href="modify.php?index='.$index.'">modify author</a>)
        (<a href="delete.php?index='.$index.'">delete author</a>)</h1>';
        $index++;
      }

    } //read line by line
    fclose($fh); //close file
  ?>