<div class="container">
<?php if(isset($staff) && ($staff->type == 'admin' ||$staff->type == 'manager')) :?>
	<!-- add achievement form -->
    <div class="box">
        <h3 id="action_click">Thêm Miễn Giảm</h3>
        <form id="show_hide_form" action="<?php echo URL; ?>achievements/add_achievement" method="POST">
			<div class="row">
				<label class="title">Tên Miễn Giảm</label>
				<input type="text" name="name" value="" required />
			</div>
			<div class="row">
				<label class="title">Giảm Học Phí (%)</label>
				<input type="text" name="sale_fee" maxlength="3" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="" required />
			</div>
			<div class="row">
				<label class="title"></label>
				<input type="submit" name="submit_add_achievement" value="Thêm" />
			</div>
        </form>
    </div>
<?php endif; ?>	
    <!-- main content output -->
    <div class="box">
		<!--
        <h3>Số Lượng Thành Tích</h3>
        <div>
            <?php echo $count_achievements; ?>
        </div>
		-->

        <h3>Danh Sách Miễn Giảm</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>STT</td>
                <td>Tên Miễn Giảm</td>
                <td>Giảm Học Phí (%)</td>
				<?php if(isset($staff) && $staff->type == 'admin') :?>
				<td>EDIT</td>
                <td>DELETE</td>
				
				<?php endif; ?>		
            </tr>
            </thead>
            <tbody>
			<?php $count = 0;?>
            <?php foreach ($achievements as $achievement) { ?>
                <tr>
                    <td><?php if (isset($achievement->achievement_id)) echo $count += 1; ?></td>
                    <td><?php if (isset($achievement->name)) echo htmlspecialchars($achievement->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($achievement->sale_fee)) echo htmlspecialchars($achievement->sale_fee, ENT_QUOTES, 'UTF-8'); ?></td>
					<?php if(isset($staff) && $staff->type == 'admin') :?>
					<td><a class="blue" href="<?php echo URL . 'achievements/edit_achievement/' . htmlspecialchars($achievement->achievement_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
                    <td><a class="red" href="<?php echo URL . 'achievements/delete_achievement/' . htmlspecialchars($achievement->achievement_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a></td>
					
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
