<div class="container">
    <!-- edit book form -->
    <div>
        <h3>Chỉnh Sửa Sách</h3>
        <form action="<?php echo URL; ?>books/update_book" method="POST">
			<div class="row">
				<label class="title">Tên Sách</label>
				<input autofocus type="text" name="name" value="<?php echo htmlspecialchars($book->name, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			<div class="row">
				<label class="title">Tiền Sách</label>
				<input autofocus type="text" name="book_fee" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo htmlspecialchars($book->book_fee, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			<div class="row">
				<label class="title"></label>
				<input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book->book_id, ENT_QUOTES, 'UTF-8'); ?>" />
				<input type="submit" name="submit_update_book" value="Chỉnh Sửa" />
			</div>
        </form>
    </div>
</div>

