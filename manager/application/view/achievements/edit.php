<div class="container">
    <!-- edit achievement form -->
    <div>
        <h3>Chỉnh Sửa Miễn Giảm</h3>
        <form action="<?php echo URL; ?>achievements/update_achievement" method="POST">
			<div class="row">
				<label class="title">Tên Miễn Giảm</label>
				<input autofocus type="text" name="name" value="<?php echo htmlspecialchars($achievement->name, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			<div class="row">
				<label class="title">Giảm Học Phí</label>
				<input autofocus type="text" name="sale_fee" maxlength="3" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo htmlspecialchars($achievement->sale_fee, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			<div class="row">
				<label class="title"></label>
				<input type="hidden" name="achievement_id" value="<?php echo htmlspecialchars($achievement->achievement_id, ENT_QUOTES, 'UTF-8'); ?>" />
				<input type="submit" name="submit_update_achievement" value="Chỉnh Sửa" />
			</div>
        </form>
    </div>
</div>

