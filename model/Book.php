<?php

class Book {

    public $id;
    public $name;
    public $author;
    public $published;


/**
   Constructor converts array (e.g. form or database row) 
   to Book object.
**/

       function __construct($array_book) {
            if (isset($array_book['id']))
                $this->id=$array_book['id'];
            if (isset($array_book['name']))    
                $this->name=$array_book['name'];
            if (isset($array_book['author']))
                $this->author=$array_book['author'];
            if (isset($array_book['published']))
                $this->published=$array_book['published'];
       }

}

?>