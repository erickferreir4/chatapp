<?php declare(strict_types=1);

/**
 *  Autoload
 */
final class ApplicationLoader
{
    public function __construct()
    {
    }

    public function loader() : void
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    /**
     *  load namespace
     *  @param $class {object} - namespace load
     */
    private function loadClass($class) : bool
    {
        $class = str_replace('\\', '/', $class);

        if( strpos($class, 'app/') !== 0 ) {
            return FALSE;
        }

        $file = __DIR__ . str_replace('app/', '/../', $class) . '.php';

        if( file_exists($file) ) {
            require_once $file;
        }
        else {
            throw new Exception("Classe {$class} nao encontrada em {$file}");
        }

        return TRUE;
    }
}
