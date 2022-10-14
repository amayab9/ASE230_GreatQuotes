<?php
          if(count($_POST)>0){
            //make sure name is not already in the file
              $error ='';
              if(file_exists('../data/authors.csv')){
                $fh = fopen('../data/authors.csv', 'r'); //open authors page in read mode
                while($line=fgets($fh)){
                  if($_POST['name'] == trim($line)){
                    //found the name already
                    $error='The author already exists';
                  }
                }
                fclose($fh); //close file
              }

              if(strlen($error)>0) echo $error;
              else{
                // Add the name to the csv file
                $fh = fopen('../data/authors.csv', 'a');
                fputs($fh,$_POST['name'].PHP_EOL);//php_eol = new line
                fclose($fh);

                header("Location: index.php");
                exit();
              }
            } // closes if statement for empty file

?>
        <h5 class="card-title">Create Author</h5>
              <form method="post">
                <h6 class="card-subtitle mb-2 text-muted">Enter Author's name</h6>
                <p class="card-text"><input type="text" name="name" class="form-control form-control-lg" placeholder="Authors Name"/></p>
                <button type="submit" class="btn btn-success">Add author</button><br /><br />

                <a href="index.php" class="btn btn-primary" role="button">Go back to index </a>
              </form>