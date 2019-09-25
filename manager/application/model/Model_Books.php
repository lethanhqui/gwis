<?php

class Model_Books
{

    function __construct($db)
    {		
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
		
    }

    public function getAllBooks()
    {
        $sql = "SELECT * FROM gwis_books 
				ORDER BY name ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addBook($name,$book_fee)
    {
        $sql = "INSERT INTO gwis_books (name,book_fee, timestamp_created) VALUES (:name,:book_fee, NOW())";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name,':book_fee' => $book_fee);
        $query->execute($parameters);
    }

    public function deleteBook($book_id)
    {
        $sql = "DELETE FROM gwis_books WHERE book_id = :book_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':book_id' => $book_id);

        $query->execute($parameters);
    }

    public function getBook($book_id)
    {
        $sql = "SELECT * FROM gwis_books WHERE book_id = :book_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':book_id' => $book_id);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function updateBook($name,$book_fee, $book_id)
    {
        $sql = "UPDATE gwis_books 
		SET name = :name ,
			book_fee = :book_fee
		WHERE book_id = :book_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':book_fee' => $book_fee,':book_id' => $book_id);

        $query->execute($parameters);
    }

    public function getCountBooks()
    {
        $sql = "SELECT COUNT(book_id) AS count_books FROM gwis_books";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->count_books;
    }
}
