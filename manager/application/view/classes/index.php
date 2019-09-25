<div class="container">
<?php if(isset($staff) && ($staff->type == 'admin' ||$staff->type == 'manager')) :?>
    <!-- add class form -->
    <div class="box">
        <h3 id="action_click">Thêm Lớp</h3>
        <form id="show_hide_form" action="<?php echo URL; ?>classes/add_class" method="POST">
		
			<div class="row">
				<label class="title">Mã Lớp</label>
				<input type="text" name="class_code" value="" required />
			</div>
			<div class="row">
				<label class="title">Tên Lớp</label>
				<input type="text" name="name" value="" required />
			</div>
			<div class="row">
				<label class="title">Học Phí</label>
				<input type="text" name="fee" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="" required />
			</div>
			<div class="row">
				<label class="title"></label>
				<input type="submit" name="submit_add_class" value="Thêm" />
			</div>
		
        </form>
    </div>
<?php endif; ?>
	
    <!-- main content output -->
    <div class="box">
		<!--
        <h3>Tổng Số Lớp</h3>
        <div>
            <?php echo $count_classes; ?>
        </div>
		-->

        <h3>Danh Sách Lớp</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Tên Lớp</td>
                <td>Học Phí</td>
				<?php if(isset($staff) && $staff->type == 'admin') :?>
				<td>EDIT</td>
                <td>DELETE</td> 
				
				<?php endif; ?>		
            </tr>
            </thead>
            <tbody>
            <?php foreach ($classes as $class) { ?>
                <tr>
                    <td><?php if (isset($class->class_code)) echo htmlspecialchars($class->class_code, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($class->name)) echo htmlspecialchars($class->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($class->fee)) echo htmlspecialchars($class->fee, ENT_QUOTES, 'UTF-8'); ?></td>
					<?php if(isset($staff) && $staff->type == 'admin') :?>
                     <td><a class="blue" href="<?php echo URL . 'classes/edit_class/' . htmlspecialchars($class->class_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
					<td><a class="red" href="<?php echo URL . 'classes/delete_class/' . htmlspecialchars($class->class_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a></td>
					
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


