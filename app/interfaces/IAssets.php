<?php declare(strict_types=1);

namespace app\interfaces;

/**
 *  Interface Assets
 */
interface IAssets
{
    public function loadStyles( string $style );

    public function loadScripts( string $scripts );
}
