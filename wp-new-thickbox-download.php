<?php

function force_download( $a ) {
	if ( empty( $a ) ) {
		die( 'Error: File not specified.' );
		return;
	}

	$a = sanitize_url( $a );

	if ( ! file_exists2( $a ) ) {
		die( 'Error: File not found. $file=' . $a );
		return;
	}

	if ( headers_sent() ) {
		die( 'Error: Headers already sent.' );
		return;
	}

	if ( ini_get( 'zlib.output_compression' ) ) {
		ini_set( 'zlib.output_compression', 'Off' );
	}

	header( 'Pragma: public' );
	header( 'Expires: 0' );
	header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
	header( 'Cache-Control: private', false );

	$b = strtolower( pathinfo( $a, PATHINFO_EXTENSION ) );

	switch ( $b ) {
		case 'jpg':
		case 'jpe':
		case 'jpeg':
			$c = 'image/jpeg';
			break;
		case 'gif':
			 $c = 'image/gif';
			break;
		case 'png':
			 $c = 'image/png';
			break;
		case 'bmp':
			 $c = 'image/bmp';
			break;
		case 'tif':
		case 'tiff':
			$c = 'image/tiff';
			break;
		case 'webp':
			 $c = 'image/webp';
			break;
		default:
			die( 'Error: Unsupported file type. $ext=' . $b );
		return;
	}

	header( 'Content-Description: File Transfer' );
	header( 'Content-Transfer-Encoding: binary' );
	header( 'Content-Type: ' . $c );
	header( 'Content-Disposition: attachment; filename="' . unsanitized_basename( $a ) . '"' );
	header( 'Content-Length: ' . filesize2( $a ) );

	ob_clean();
	flush();
	readfile( $a );
}

function file_exists2( $a ) {
	return preg_match( '/^https?:\/\//i', $a) ? !! @fopen( $a, 'r' ) : file_exists( $a );
}

function filesize2( $a ) {
	return preg_match( '/^https?:\/\//i', $a ) ? strlen( file_get_contents( $a ) ) : filesize( $a );
}

function sanitize_url( $d ) {
	$d = str_replace( array( '%', ' ', '\\' ), array( '%25', '%20', '' ), $d );
	$d = preg_replace( '/\?.*$/i', '', $d );
	return $d;
}

function unsanitized_basename( $d ) {
	$d = str_replace( array( '%25', '%20' ), array( '%', ' ' ), basename( $d ) );
	return basename( $d );
}

force_download( str_replace( chr( 0 ), '', $_GET['file'] ) );
exit;
