<?php


require('utils/DBUtils.php');

class BookDAO {

    
    function __construct() {
        #print "BOOKDAO constructor\n";
        $dbutils=new DBUtils();
        $this->dbconnection=$dbutils->connectToDatabase();
    }

    public $dbconnection;



function addBook($book){
    try { 
        $sql = 'INSERT INTO BOOKS (name, author, published) VALUES(?, ?, ?)';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $result = $sth->execute(([$book->name, $book->author, $book->published]));
        return $result;
    }
    catch (DTOException $e){
        throw (new Exception("Error when adding a book!".$e->getMessage()));
    }
}

function updateBook($book){
    try { 
        ##echo print_r($book);
        $sql = 'UPDATE BOOKS SET name=?, author=?, published=? WHERE id=?';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $result = $sth->execute(([$book->name, $book->author, $book->published, $book->id]));
        return $result;
    }
    catch (DTOException $e){
        throw (new Exception("Error when updating a book!".$e->getMessage()));
    }
}

/**
   Kun kirjoihin liitetään lainauksia, pitää kirjaan liittyvät 
   lainaukset poistaa ennen kuin kirja voidaan poistaa. Muuten 
   kirjan poisto epäonnistuu lapsitietuiden vuoksi.
**/

function deleteBook($id){
    try { 
        $sql = 'DELETE FROM BOOKS  
        WHERE id = :id';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $id));
    }
    catch (DTOException $e){
        throw (new Exception("Error when deleting a book!".$e->getMessage()));
    }
}
/**
  Return list of Book -objects. You need to convert every row to 
  object using the constructor of the Book-class, which converts 
  array to object.
**/

function getBooks(){
    try {
        $sql = 'SELECT * FROM BOOKS';  
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        $book_rows = $sth->fetchAll();
        $books = [];
        foreach ($book_rows as $book_row) {
          //echo print_r($book_row);
          array_push($books, new Book($book_row));
        }
        return $books;
    }
    catch (DTOException $exception) {
        echo $exception->getMessage();
        throw (new Exception("Error when getting books!"));
    }
}




function getBookById($id){
    try { 
        $sql = 'SELECT * FROM BOOKS  
        WHERE id = :id';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $id));
        $book_row = $sth->fetch();
        if ($book_row==null){
            echo "book was null";
            return null;
        }
        //Kun rivejä on vain yksi, muunnetaan se kirja-objektiksi
        //ennen palautusta.
        else {
            ##echo print_r($book_row);
            return new Book($book_row);
        }
    }
    catch (DTOException $e){
        throw (new Exception("Error when getting book by id!"));
    }
}

function createBooksTable(){
    try {
         $dbutils=new DBUtils();
         $db=$dbutils->connectToDatabase();
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "CREATE TABLE BOOKS (
             id INTEGER PRIMARY KEY AUTOINCREMENT,
             name VARCHAR(200) NOT NULL,
             author VARCHAR(200) NOT NULL,
             published integer,
             description TEXT);";
        $db->exec($sql);
        
    }
    catch (Exception $exception){
        //älä liitä mukaan varsinaista virhe tekstiä $exception->getMessage()
        //koska se voi sisältää liikaa tietoa tietokannan rakenteesta 
        //joka ei kuulu loppukäyttäjälle. 
       throw (new Exception('Creating database failed.'));
    }
}
}
?>