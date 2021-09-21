<?php

require('./components/BookComponents.php');

require ('views/header.php');


  $navigation = getNavigation();
  $booksComponents = new BookComponents();
  $book_form = $booksComponents->getBookForm(); 
?>




<!DOCTYPE html><html lang="en">
<head>  
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>Library</title>  
<body>  
<div>
 <?php
        
        echo $navigation
        
 ?>
</div>
<div class="container">    
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Lisää kirja</h1>
        <?php
        
        echo $book_form
        
        ?>
    </div>
</div>  
</div>  
</body></html>