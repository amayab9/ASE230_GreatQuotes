<!-- Need to mirror index under quotes folder that shows Quotes list attributed to author/source --> 

<h2><a href="create.php">Add a new author</a><hr /></h2>
<?php
  session_start();
  // we wnat the index to read the authors.csv every time to pick up changes
  $error = '';
  $count_rows = 0;
  if(file_exists('../data/authors.csv')){

    $fh = fopen('../data/authors.csv', 'r'); //open authors page in read mode
    $index=0;
    $authorID = '';
    $author_name = '';
    while(($line=fgetcsv($fh, 0, ",")) !== FALSE){
      if(strlen($line[0])>0) {
        $authorID=$line[0];
        $author_name=$line[1];
        $count_rows += 1;
        // links to page, but has browser repeat search on the linked page
        echo '<h1><a href="detail.php?index='.$authorID.'">'.trim($author_name).'</a>
        (<a href="detail.php?authorID='.$authorID.'">view author</a>)
        (<a href="modify.php?authorID='.$authorID.'">modify author</a>)
        (<a href="delete.php?authorID='.$authorID.'">delete author</a>)</h1>';
        $index++;
      }
      // $error = 'there are no authors in our index';
      // break;


    } //read line by line
    fclose($fh); //close file
  } else {
    $error = 'no such file';
}

if (strlen($error)>1) echo $error;
if ($count_rows == 0) echo 'There are no authors in the database. Please add an author.';
?>
