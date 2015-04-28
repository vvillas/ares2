<?php
// $msgs = Control::getUserMessages();
if (count ( $v_msgs ) > 0)
	foreach ( $v_msgs as $e ) {
		
		echo '<div id="error_box" >';
		if (is_array ( $v_msgs )) {
			echo '<div id="error_msg" class="cx_r mb">';
			foreach ( $v_msgs as $e ) {
				echo '<p class="ppa mpa">'.$e.'</p>';
			}
			echo '</div>';
		}
		echo '</div>';
	}
?>