<?php


class BookComponents {

function getBookForm(){
    $form_str='<div>  
            <form method="post" action="index.php"> 
            <div class="form-group"> 
            <input type="hidden" name="action" value ="addNewBook">
            <label for="name">Nimi:</label> 
            <input type="text" class="form-control" name="name" /> </div>
            <div class="form-group"> 
            <label for="author">Kirjailija:</label> 
            <input type="text" class="form-control" name="author" /> </div>
            <div class="form-group"> 
            <label for="price">Julkaisuvuosi:</label> 
            <input type="text" class="form-control" name="published" /> </div>
            <button type="submit" class="btn btn-primary">Lisää kirja</button>
            </form>
        </div>';

    return $form_str;
}

function getEditBookForm($book){
    ##echo print_r($book);
    $form_str='<div>  
            <form method="post" action="index.php"> 
            <div class="form-group"> 
            <input type="hidden" name="id" value ="'.$book->id.'">
            <input type="hidden" name="action" value ="updateBook">
            <label for="name">Nimi:</label> 
            <input type="text" class="form-control" name="name" value="'.$book->name.'"/> </div>
            <div class="form-group"> 
            <label for="author">Kirjailija:</label> 
            <input type="text" class="form-control" name="author" value="'.$book->author.'"/> </div>
            <div class="form-group"> 
            <label for="price">Julkaisuvuosi:</label> 
            <input type="text" class="form-control" name="published" value="'.$book->published.'"/> </div>
            <button type="submit" class="btn btn-primary">Tallenna</button>
            </form>
        </div>';

    return $form_str;
}

function getNewBookButton(){
    return '<a style="margin: 19px;" href="/add_book.php" class="btn btn-primary">
        Lisää uusi kirja</a>';
}

function getBooksComponent($books){
    ##echo print_r($books);
    $books_str='<table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nimi</th>
                    <th>Kirjailija</th>
                    <th>Julkaisuvuosi</th>
                    <th colspan=2 style="vertical-align: center">Toimenpiteet</th>
                </tr>
            </thead>
            <tbody>';
            foreach($books as $book){  
                $books_str=$books_str.'<tr>
                    <td>'.$book->id.'</td>
                    <td>'.$book->name.'</td>
                    <td>'.$book->author.'</td>
                    <td>'.$book->published.'</td>
                    <td> <form action="edit_book.php" method="post"> 
                        <input type="hidden" name="id" value="'.$book->id.'">
                        <button class="btn btn-secondary" type="submit">Muokkaa</button> 
                        </form></td>
                    <td>
                        <form action="index.php" method="post"> 
                        <input type="hidden" name="action" value="deleteBook">
                        <input type="hidden" name="id" value="'.$book->id.'">
                        <button class="btn btn-danger" type="submit">Poista</button> 
                        </form>
                    </td>
                </tr>';
            };
                $books_str=$books_str.'</tbody></table>';
                return $books_str;
}
}