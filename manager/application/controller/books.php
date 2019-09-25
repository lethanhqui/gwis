<?php


Class Books extends Controller
{

    public function index()
    {
		if(!$this->login->is_logged_in()){ header('Location: '.URL.'login/'); } 
		
        $books = $this->books->getAllBooks();
        $count_books = $this->books->getCountBooks();
		
		$staff = $this->staffs->getStaff($_SESSION['staff_id']);

        require APP . 'view/_templates/header.php';
        require APP . 'view/books/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function add_book()
    {

        if (isset($_POST["submit_add_book"])) {
            $this->books->addBook($_POST["name"], $_POST["book_fee"]);
        }

        header('location: ' . URL . 'books/index');
    }

    public function delete_book($book_id)
    {
        if (isset($book_id)) {
            $this->books->deleteBook($book_id);
        }

        header('location: ' . URL . 'books/index');
    }

    public function edit_book($book_id)
    {
        if (isset($book_id)) {
            $book = $this->books->getBook($book_id);

            require APP . 'view/_templates/header.php';
            require APP . 'view/books/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {

            header('location: ' . URL . 'books/index');
        }
    }

    public function update_book()
    {

        if (isset($_POST["submit_update_book"])) {
            $this->books->updateBook($_POST["name"],$_POST["book_fee"], $_POST['book_id']);
        }

        header('location: ' . URL . 'books/index');
    }

}
