<?php
$ftp = array(
	'server' => 'ftp.example.com',
	'user' => 'yourusername',
	'pass' => 'yourpassword'
);

// Connect
$ftp_connection = ftp_connect( $ftp['server'] ) or die( 'Could not connect to $ftp[$server]' );

// Set passive mode
ftp_pasv( $ftp_connection, false );

if ( $login = ftp_login( $ftp_connection, $ftp['user'], $ftp['pass'] ) ) {

	// Login passed
	
	// Download data to this file.
	$local_file = 'datafeed.csv.';

	// Path and filename to open and read from.
	$server_file = 'public_html/ftpfiles/data-example-2.csv';

	// Download File
	if ( $file = ftp_get( $ftp_connection, $local_file, $server_file, FTP_ASCII ) ) {

		$handle = fopen( $local_file, "r" ) or die( "Couldn't get handle" );

		if ( $handle ) {

		    while ( !feof( $handle ) ) {

		    	// Output data.
		        $buffer = fgets( $handle, 4096 );
		        echo $buffer;

		    }

		    fclose( $handle );

		} else {

			// $handle failed
			echo "Failed to get handle.";

		}

	} else {

		// ftp_get failed
		echo "Failed to download file.";

	}

} else {

	// Login failed
	echo "Failed to log in.";

}

// Disconnect
ftp_close( $ftp_connection );
?>