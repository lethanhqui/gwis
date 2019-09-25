<div class="wpas-ticket-buttons-top">
	<?php wpas_make_button( __( 'Danh Sách Yêu Cầu', 'awesome-support' ), array( 'type' => 'link', 'link' => wpas_get_tickets_list_page_url(), 'class' => 'wpas-btn wpas-btn-default wpas-link-ticketlist' ) ); ?>
	<?php wpas_make_button( __( 'Tạo thêm yêu cầu hổ trợ', 'awesome-support' ), array( 'type' => 'link', 'link' => wpas_get_submission_page_url(), 'class' => 'wpas-btn wpas-btn-default wpas-link-ticketnew' ) ); ?>
	<?php wpas_make_button( __( 'Đăng Xuất', 'awesome-support' ), array( 'type' => 'link', 'link' => wp_logout_url(), 'class' => 'wpas-btn wpas-btn-default wpas-link-logout' ) ); ?>
</div>