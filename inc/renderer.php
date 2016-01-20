<?php

/**
* Renderer
*/
class Renderer
{

  private static $instance;

  private $path;
  private $url;
  
  protected function __construct()
  {
    $path = dirname( __FILE__ );
    $path = str_replace( '/the-hood/inc', '',  $path );

    $this->path = $path;

    $this->url = "http://staticcms.dev/the-hood";
  }

  private function __clone() {}

  private function __wakeup() {}

  public function get_instance() {

    if ( null === static::$instance )
      static::$instance = new static();

    return static::$instance;
  }

  public function render_pages() {
    var_dump ( $this->path );
  }

  public function render_page( $path ) {

    if ( empty( $path ) )
      return false;

    $build_url = $this->url . "/site";

    if ( $build_url != "/" )
      $build_url = $build_url . $path;

    $file_directory = "/Users/andrewfarinella/Documents/Testing/Static CMS/public_html" . $path;

    if ( ! file_exists( $file_directory ) )
      mkdir( $file_directory, 0777, true );

    $file_path = $file_directory . "/index.html";

    return copy( $build_url, $file_path );
  }
}