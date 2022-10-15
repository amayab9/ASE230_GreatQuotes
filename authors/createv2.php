<?php
// this create file produces a unique key for every new author added.
// I propose this option to help us with the delete function.
session_start();
$fileLineCount = 0;
$authorID = '';
$found = 0;
$error = '';
$message= '';
if(count($_POST)>0){
  if(file_exists('../data/authorsv2.csv')){
      $fh = fopen('../data/authorsv2.csv', 'r');

      while(($line=fgetcsv($fh, 0, ",")) !== FALSE) {
        $fileLineCount += 1;
        if($_POST['name'] == trim($line[1])){
          $found = TRUE;
          $authorID = $line[0];
          $message= $_POST['name']." already in list at ".$authorID;
          // once we are ready to tie this to the quotes,
          // we should be able to grab this unique ID to link author in
          // add a quote function

        } else {
          $found = FALSE;
          // 'author not found'
        }
      }
      fclose($fh);
      if($found == FALSE){
        $fileLineCount += 1;
        // current format of unique ID is a followed by 5 digits
        // the end digit(s) represent the current row count +1 of the authorsv2.csv
        $spaces = str_repeat("0",(5 - strlen($fileLineCount)));
        $authorID = 'A'.$spaces.$fileLineCount;
        $author_ra = ($authorID.",".$_POST['name']);
        $fh = fopen('../data/authorsv2.csv', 'a');
        fputcsv($fh, explode(',',$author_ra));
        fclose($fh);
        // echo 'count '.$fileLineCount.' length '.$spaces.' prefix '.$authorID;
        $message= 'Thanks for adding "'.$_POST['name'].'" to our amazing website!';
      }
  } else {
    $error = 'no such file';
  }

} else{
  $error = 'Type a name in the box';
}
if (strlen($error)>1) echo $error;
if (strlen($message)>1) echo $message;
?>
<h5 class="card-title">Create Author</h5>

      <form method="post">
        <h6 class="card-subtitle mb-2 text-muted">Enter Author's name</h6>
        <p class="card-text"><input type="text" name="name" class="form-control form-control-lg" placeholder="Authors Name"/></p>
        <button type="submit" class="btn btn-success">Add author</button><br /><br />

        <a href="indexv2.php" class="btn btn-primary" role="button">Go back to index </a>
      </form>
