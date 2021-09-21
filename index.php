<?php


require('./dao/BookDAO.php');
require('./model/Book.php');
require('./components/BookComponents.php');

require ('views/header.php');


$bookDAO = new BookDAO();
##$bookDAO->createBooksTable();

if (isset($_POST["action"])){
   $action = $_POST["action"];

   if ($action == "addNewBook"){
     $book = new Book($_POST);
     $result = $bookDAO->addBook($book);
   }
   else if ($action == "deleteBook"){
     $result = $bookDAO->deleteBook($_POST['id']);
   }
   else if ($action == "updateBook"){
     $book = new Book($_POST);
     $result = $bookDAO->updateBook($book);
   }
}

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<?php
  $navigation = getNavigation();
  $booksComponents = new BookComponents();
  $new_book_button = $booksComponents->getNewBookButton(); 
  echo $navigation;
  echo $new_book_button;
?>

 <div class="col-sm-12">
 <h1 class="display-3">Kirjat</h1>

<?php 

   $books = $bookDAO->getBooks();
   $bookList = $booksComponents->getBooksComponent($books);
   echo $bookList;
?>     
</div>

</body>
</html>