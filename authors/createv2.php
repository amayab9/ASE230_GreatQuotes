<?php
  session_start();
  // require('../functions.php');
  // this create file produces a unique key for every new author added.
  // I propose this option to help us with the delete function.
  // $filename = '../data/authorsv2.csv';
  $fileLineCount = 0;
  $authorID = '';
  $found = 'null';
  $error = '';
  $message= '';
  if(count($_POST)>0){
    if(file_exists('../data/authorsv2.csv')){
      // $authorID = get_authorID($_POST['name'], $filename);
      $fh = fopen('../data/authorsv2.csv', 'r');

        while(($line=fgetcsv($fh, 0, ",")) !== FALSE) {
          $fileLineCount += 1;
          $temp = '';
          if(isset($line[1])){
            if(trim($_POST['name']) == trim($line[1])){
              $found = 'found';
              $authorID = $line[0];
              $message= $_POST['name']." already in list at ".$authorID;
              break;
            } else {
              $found = 'no';
              // 'author not found'
            }
          } else {continue;}

            // once we are ready to tie this to the quotes,
            // we should be able to grab this unique ID to link author in
            // add a quote function
        }
        fclose($fh);

        if($found == 'no'){
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

        } $message= $_POST['name'].' is labeled '.$authorID.' on our amazing website!';

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

<!--      // $fh = fopen('../data/authorsv2.csv', 'r');
      //
      // while(($line=fgetcsv($fh, 0, ",")) !== FALSE) {
      //   $fileLineCount += 1;
      //   if(trim($_POST['name']) == trim($line[1])){
      //     $found = 'found';
      //     $authorID = $line[0];
      //     $message= $_POST['name']." already in list at ".$authorID;
      //     break;
      //     // once we are ready to tie this to the quotes,
      //     // we should be able to grab this unique ID to link author in
      //     // add a quote function
      //
      //   } else {
      //     $found = 'no';
      //     // 'author not found'
      //   }
      // }
      // fclose($fh);
      //
      // if($found == 'no'){
      //   $fileLineCount += 1;
      //   // current format of unique ID is a followed by 5 digits
      //   // the end digit(s) represent the current row count +1 of the authorsv2.csv
      //   $spaces = str_repeat("0",(5 - strlen($fileLineCount)));
      //   $authorID = 'A'.$spaces.$fileLineCount;
      //   $author_ra = ($authorID.",".$_POST['name']);
      //   $fh = fopen('../data/authorsv2.csv', 'a');
      //   fputcsv($fh, explode(',',$author_ra));
      //   fclose($fh);
        // echo 'count '.$fileLineCount.' length '.$spaces.' prefix '.$authorID;
-->
