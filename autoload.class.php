<?php
class Autoload
{
    public function __construct()
    {
        $dirs = [ 'app/', 'classes/' ];
        foreach( $dirs as $dir ) {
            if( file_exists( $dir ) ) {
                foreach( scandir( __DIR__ .'/'. $dir ) as $file ) {
                    if( ! in_array( $file, ['.', '..'] ) )
                        include_once $dir.$file;
                }
            }
        }
    }
}
new Autoload();

if( file_exists('vendor/autoload.php') )
    require_once 'vendor/autoload.php';
