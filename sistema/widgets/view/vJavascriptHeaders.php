<?php
if (count ( $js_files ) > 0) {
	foreach ( $js_files as $js ) {
		
		echo '<script type="text/javascript" src='.$js.'></script>';

	}
}
?>