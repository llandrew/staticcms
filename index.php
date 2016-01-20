<?php

require_once( "build.php" ); 

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Static CMS - The Hood</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.1.1/foundation-flex.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.1.1/foundation.min.css">

      <style type="text/css">

        .alert {
          margin: 15px 30px;
          padding: 10px 30px;

          background-color: lightgray;
          border: 2px solid black;
          border-radius: 10px;
        }
        .alert--success {
          background-color: #D1F5BE;
          border-color: #9CDE9F;
        }
        .alert--error {
          background-color: #FCB0B3;
          border-color: #EF3E36;
        }
      </style>

      <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  </head>
  <body>


    <?php

    global $db;

    $content = '';

    $sql = "SELECT * FROM temp WHERE id=1";

    if ( ! $content_query = $db->query( $sql ) )
      die( "There was an error running the query [{$db->error}]." );

    while ( $row = $content_query->fetch_assoc() ) {
      $content = $row['value'];
    }

    if ( isset( $_POST['action'] ) && $_POST['action'] == 'render' ) {

      /**
       * Update the page content.
       */

      $sql = "UPDATE temp SET value='{$_POST['content']}' WHERE id=1";

      $content = $_POST['content'];

      if ( ! $result = $db->query( $sql ) )
        die( "There was an error running the query [{$db->error}]." );

      /**
       * Get an instance of the page renderer;
       */

      $renderer = Renderer::get_instance();


      /**
       * Build the front page
       */

      if ( $renderer->render_page( "/" ) )
        echo '<div class="alert alert--success">Front page has been successfully built. View at <a href="http://staticcms.dev" target="_blank">StaticCMS</a>.</div>';
      else
        echo '<div class="alert alert--error">Front page could not be built.</div>';


      /**
       * Build a sub directory
       */

      if ( $renderer->render_page( "/about" ) )
        echo '<div class="alert alert--success">About page has been successfully built. View at <a href="http://staticcms.dev" target="_blank">StaticCMS</a>.</div>';
      else
        echo '<div class="alert alert--error">About page could not be built.</div>';
    }
    ?>

    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

    <form action="" method="post">
      <div class="row">
        <div class="small-6 columns">
          <label>
            <h2>Page Content</h2>
            <textarea name="content" placeholder="None" rows="5"><?= $content; ?></textarea>
          </label>
        </div>
<!--         <div class="small-6 columns">
          <label>
            <h2>About Page Content</h2>
            <textarea name="about_content" placeholder="None" rows="5"><?= $about_content; ?></textarea>
          </label>
        </div> -->
      </div>
      <div class="row">
        <div class="columns">
          <input type="hidden" name="action" value="render">
          <input type="submit" value="Render">
        </div>
      </div>
    </form>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.1.1/foundation.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
  </body> 
</html>