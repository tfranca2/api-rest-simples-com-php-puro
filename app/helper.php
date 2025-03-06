<?php

function dd() {
	$bt = debug_backtrace();
	$caller = array_shift( $bt );
	echo '- '.$caller['file'].':<b>'.$caller['line'].'</b><br/>';

	$args = func_get_args();
	if( $args ) {
		echo '<pre>';
		print_r( $args );
		echo '</pre>';
	}

	exit();
}

function normalizeFiles() {
	$out = [];
	foreach ($_FILES as $key => $file) {
		if (isset($file['name']) && is_array($file['name'])) {
			$new = [];
			foreach (['name', 'type', 'tmp_name', 'error', 'size'] as $k) {
				array_walk_recursive($file[$k], function (&$data, $key, $k) {
					$data = [$k => $data];
				}, $k);
				$new = array_replace_recursive($new, $file[$k]);
			}
			$out[$key] = $new;
		} else {
			$out[$key] = [$file];
		}
	}
	return $out;
}