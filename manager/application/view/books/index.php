<div class="container">
<?php if(isset($staff) && ($staff->type == 'admin' ||$staff->type == 'manager')) :?>
	<!-- add book form -->
    <div class="box">
        <h3 id="action_click">Thêm Sách</h3>
        <form id="show_hide_form" action="<?php echo URL; ?>books/add_book" method="POST">
			<div class="row">
				<label class="title">Tên Sách</label>
				<input type="text" name="name" value="" required />
			</div>
			<div class="row">
				<label class="title">Tiền Sách</label>
				<input type="text" name="book_fee" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="" required />
			</div>
			<div class="row">
				<label class="title"></label>
				<input type="submit" name="submit_add_book" value="Thêm" />
			</div>
        </form>
    </div>
<?php endif; ?>	
    <!-- main content output -->
    <div class="box">
		<!--
        <h3>Số Lượng Thành Tích</h3>
        <div>
            <?php echo $count_books; ?>
        </div>
		-->

        <h3>Danh Sách</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>STT</td>
                <td>Tên Sách</td>
                <td>Tiền Sách</td>
				<?php if(isset($staff) && $staff->type == 'admin') :?>
				<td>EDIT</td>
                <td>DELETE</td>
				<?php elseif(isset($staff) && $staff->type == 'manager') :?>
                <td>EDIT</td>
				<?php endif; ?>		
            </tr>
            </thead>
            <tbody>
			<?php $count = 0;?>
            <?php foreach ($books as $book) { ?>
                <tr>
                    <td><?php if (isset($book->book_id)) echo $count += 1; ?></td>
                    <td><?php if (isset($book->name)) echo htmlspecialchars($book->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($book->book_fee)) echo htmlspecialchars($book->book_fee, ENT_QUOTES, 'UTF-8'); ?></td>
					<?php if(isset($staff) && $staff->type == 'admin') :?>
					<td><a class="blue" href="<?php echo URL . 'books/edit_book/' . htmlspecialchars($book->book_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
                    <td><a class="red" href="<?php echo URL . 'books/delete_book/' . htmlspecialchars($book->book_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a></td>
					<?php elseif(isset($staff) && $staff->type == 'manager') :?> 
					<td><a class="blue" href="<?php echo URL . 'books/edit_book/' . htmlspecialchars($book->book_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
					<?php endif; ?>					
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
 
  $(document).ready(function(){
	
	$("#action_click").click(function(){
		$("#show_hide_form").toggle();
	});

  } );
  </script>
