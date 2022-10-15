<h2><a href="createv2.php">Add a new author</a><hr /></h2>
<?php
  // we wnat the index to read the authors.csv every time to pick up changes
  $error = '';
  if(file_exists('../data/authorsv2.csv')){

    $fh = fopen('../data/authorsv2.csv', 'r'); //open authors page in read mode
    $index=0;
    $authorID = '';
    $author_name = '';
    while(($line=fgetcsv($fh, 0, ",")) !== FALSE){
      if(strlen($line[0])>0) {
        $authorID=$line[0];
        $author_name=$line[1];
        // links to page, but has browser repeat search on the linked page
        echo '<h1><a href="detail.php?index='.$index.'">'.trim($author_name).'</a>
        (<a href="detail.php?index='.$index.'">view author</a>)
        (<a href="modify.php?index='.$index.'">modify author</a>)
        (<a href="delete.php?index='.$index.'">delete author</a>)</h1>';
        $index++;
      }

    } //read line by line
    fclose($fh); //close file
} else {
  $error = 'no such file';
}


?>
