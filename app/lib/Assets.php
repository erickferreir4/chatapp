<?php declare(strict_types=1);

namespace app\lib;

use app\interfaces\IAssets;

/**
 *  Assets
 */
class Assets implements IAssets
{
    /**
     *  Load styles
     *  @param {string} $style - name style
     *  @return {string} $src - css html
     */
    public function loadStyles( string $style ) : string
    {
        $src = file_get_contents(__DIR__ . '/../html/templates/css.html');
        $src = str_replace('[[CSS]]', "/assets/css/{$style}.css", $src);

        return $src;
    }

    /**
     *  Load Scripts
     *  @param {string} $script - name script
     *  @return {string} $src - script html
     */
    public function loadScripts( string $script ) : string
    {
        $src = file_get_contents(__DIR__ . '/../html/templates/js.html');
        $src = str_replace('[[JS]]', "/assets/js/{$script}.js", $src);

        return $src;
    }
}
