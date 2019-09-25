<div class="container">

    <!-- add class form -->
    <div>
        <h3>Chỉnh Sửa Lớp</h3>
        <form action="<?php echo URL; ?>classes/update_class" method="POST">
			
			<div class="row">
				<label class="title">Mã Lớp</label>
				<input autofocus type="text" name="class_code" value="<?php echo htmlspecialchars($class->class_code, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			<div class="row">
				<label class="title">Tên Lớp</label>
				<input autofocus type="text" name="name" value="<?php echo htmlspecialchars($class->name, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			<div class="row">
				<label class="title">Tiền Phí</label>
				<input autofocus type="text" name="fee" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo htmlspecialchars($class->fee, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			<div class="row">
				<label class="title"></label>
				<input type="hidden" name="class_id" value="<?php echo htmlspecialchars($class->class_id, ENT_QUOTES, 'UTF-8'); ?>" />
				<input type="submit" name="submit_update_class" value="Chỉnh Sửa" />
			</div>
			
        </form>
    </div>
</div>

