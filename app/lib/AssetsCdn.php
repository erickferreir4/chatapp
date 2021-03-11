<?php declare(strict_types=1);

namespace app\lib;

use app\interfaces\IAssets;

/**
 *  Assets CDN
 */
class AssetsCdn implements IAssets
{
    /**
     *  Load Styles CDN
     *  @param {string} $style - link cdn
     *  @return {string} $src - css html
     */
    public function loadStyles( string $link ) : string
    {
        $src = file_get_contents(__DIR__ . '/../html/templates/css.html');
        $src = str_replace('[[CSS]]', $link, $src);

        return $src;
    }

    /**
     *  Load Script CDN
     *  @param {string} $script - link script
     *  @return {string} $src - script html
     */
    public function loadScripts( string $link ) : string
    {
        $src = file_get_contents(__DIR__ . '/../html/templates/js.html');
        $src = str_replace('[[CSS]]', $link, $src);

        return $src;
    }
}
