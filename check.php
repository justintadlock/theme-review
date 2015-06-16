<?php

function theme_review_checker( $preg, $file, $item ) {
	$lines = file( $file, FILE_IGNORE_NEW_LINES ); // Read the theme file into an array
	$line_index = 0;
	$bad_lines = '';
	$error = '';
 	$filename = ( preg_match( '/themes\/[a-z0-9]*\/(.*)/', $file, $out ) ) ? $out[1] : basename( $file );

	foreach( $lines as $this_line ) {
		if ( preg_match( $preg, $this_line, $matches ) ) {
			$filename = ( preg_match( '/themes\/[a-z0-9]*\/(.*)/', $file, $out ) ) ? $out[1] : basename( $file );
			$error = $matches[0];
			$this_line = str_replace( '"', "'", $this_line );
			$error = ltrim( $error );
			$pre = ( FALSE !== ( $pos = strpos( $this_line, $error ) ) ? substr( $this_line, 0, $pos ) : FALSE );
			$pre = ltrim( htmlspecialchars( $pre ) );
			echo $bad_lines .= "<pre class='tc-grep'>" . __("WARNING: manual check required:<br>", "theme-review")	. $item . __(" found in", "theme-review") . " " . $filename . " " . __("line ", "theme-review") . ( $line_index+1 ) . ":<br> " . $pre . htmlspecialchars( substr( stristr( $this_line, $error ), 0, 175 ) ) . "</pre>";
		}
		$line_index++;
	}
}

?>