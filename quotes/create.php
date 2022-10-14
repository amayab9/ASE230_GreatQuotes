<?php
session_start();
          if(count($_POST)>0){
            //make sure quote is not already in the file
            /// NEED TO THINK MORE ON THIS ONE
            /// Can't add quote without author, should we have links between
            /// create author and create quote to direct user to enter both?
            /// author check is for 'author exists' but author to quote is a 1 to many relationship
              $error ='';
              if(file_exists('../data/quotes.csv')){
                $fh = fopen('../data/quotes.csv', 'r'); //open quotes page in read mode
                while($line=fgets($fh)){
                  if($_POST['quote'] == trim($line)){
                    //found the text already
                    $error='The quote already exists';
                  }
                }
                fclose($fh); //close file
              }

              if(strlen($error)>0) echo $error;
              else{
                // Add the name to the csv file
                $fh = fopen('../data/quotes.csv', 'a');
                $authorLineNum = $_SESSION['authorLineNumber']; //line 25 and 26 allows us to store index of author with the quote
                fputs($fh,$authorLineNum.';'.$_POST['quote'].PHP_EOL);//php_eol = new line
                fclose($fh);

                echo 'Thanks for adding "'.$_POST['quote'].'" to our amazing website!';
              }
            } // closes if statement for empty file

        ?>
<form method="post">
          Enter your quote.  <br />
          <input type="text" name="quote" placeholder="quote"/><br />
          <button type="submit" >Add to the collection</button>
        </form>