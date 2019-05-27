<?php
acx_fsmi_hook_function('acx_fsmi_exprt_hook_option_exprt_quick');
acx_fsmi_hook_function('acx_fsmi_exprt_hook_option_form_head');

$page = "";
if(ISSET($_GET['page']))
{
	$page = sanitize_text_field(trim($_GET['page']));
}
if($page == "Acurax-Social-Icons-Expert-Support")
{
acx_fsmi_quick_form();
}
acx_fsmi_hook_function('acx_fsmi_exprt_hook_option_fields');
acx_fsmi_hook_function('acx_fsmi_exprt_hook_option_sidebar'); 
?>
