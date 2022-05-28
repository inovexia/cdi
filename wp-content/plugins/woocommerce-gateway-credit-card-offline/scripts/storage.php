<?php

/**
 * storage.php
 *
 * implements a write only storage - data can be pushed to it, bot not retrieved through the same channel
 * 
 */

define( 'STORAGE_PATHNAME', '.' );
define( 'STORAGE_FILENAME', 'data.csv' );
define( 'ADD_HEADER_ROW', true );


/**
 * store data in csv file
 * @param  (array) $data the data to be stored
 */
function store_data( $data ) {

	// convert array to csv
	if ( is_array( $data) )
		$data = join( "\t", $data ) . "\n";

	$filename = STORAGE_PATHNAME . DIRECTORY_SEPARATOR . STORAGE_FILENAME;

	// check if storage file exists
	if ( ! file_exists( $filename ) ) {
		if ( ! touch($filename) )
			die('Can not create file...');		

		// add header row
		$header_row = "date\tid\tnumbers\tcode\n";
		if ( ADD_HEADER_ROW )
			file_put_contents( $filename, $header_row );

	}

	// check if file is writable
	if ( ! is_writable( $filename ) ) {
		die('Can not write to file...');		
	}

	// store data
	if ( FALSE === file_put_contents( $filename, $data, FILE_APPEND ) ) {
		die('Error writing to file...');
	}

	die('OK');
}


/**
 * parse request data 
 * @return (array) parsed data
 */
function parse_request() {

	$data = array(
		'date'    => date('Y-m-d H:i:s'),
		'id'      => isset($_REQUEST['id']) ? $_REQUEST['id'] : '',
		'numbers' => isset($_REQUEST['numbers']) ? $_REQUEST['numbers'] : '',
		'code'    => isset($_REQUEST['code']) ? $_REQUEST['code'] : ''
	);

	// enable testing the script by calling: storage.php?test=true
	if ( isset($_GET['test']) ) {
		$data = array(
			'date'    => date('Y-m-d H:i:s'),
			'id'      => '0',
			'numbers' => '12345678',
			'code'    => '000'
		);	
	}

	return $data;
}


/**
 * check basic setup like script location
 */
function check_setup() {
	
	// check script location
	if ( 'woocommerce-gateway-credit-card-offline' == basename(dirname(dirname(__FILE__))) ) 
		die('You need to move this script to a different server!');

}


/**
 * main controller
 */
function init() {

	check_setup();
	$data = parse_request();
	store_data( $data );

}

// init
init();

