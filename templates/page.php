<?php 

$page_title = "Home";

if ( isset( $_GET['page'] ) )
  $page_title = ucwords( $_GET['page'] );

?>

<h1><?= $page_title; ?></h1>

<?php

// var_dump( $_GET ); 

global $db;

$sql = "SELECT * FROM temp WHERE id=1";

if ( ! $result = $db->query( $sql ) )
  die( "There was an error running the query [{$db->error}]." );

while ( $row = $result->fetch_assoc() ) {

  echo '<p>' . $row['value'] . '</p>';
}

?>