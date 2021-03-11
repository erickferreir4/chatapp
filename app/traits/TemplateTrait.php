<?php declare(strict_types=1);

namespace app\traits;

use app\interfaces\IAssets;
use app\lib\Assets;
use app\lib\AssetsCdn;

/**
 *  Default config all pages
 */
trait TemplateTrait
{
    private $title;
    private $assets;
    private $styles;
    private $scripts;

    /**
     *  Set Layout 
     */
    private function layout($layout) : void
    {
        $this->general();
        require_once __DIR__ . '/../view/_includes/_head.php';
        require_once __DIR__ . '/../view/_includes/_header.php';
        require_once __DIR__ . "/../view/".ucfirst($layout)."View.php";
        require_once __DIR__ . '/../view/_includes/_footer.php';
    }

    /**
     *  Set Title
     *  @param {string} $title - title name page
     */
    private function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    /**
     *  Set Assets
     *  @param {IAssets} $assets - object assets
     */
    private function setAssets( IAssets $assets) : void
    {
        $this->assets = $assets;
    }

    /**
     *  Add css in page
     *  @param {string} $style - name style
     */
    private function addCss(string $style) : void
    {
        $this->styles = $this->assets->loadStyles($style) . $this->styles;
    }

    /**
     *  Add js in page
     *  @param {sring} $script - name script
     */
    private function addJs(string $script) : void
    {
        $this->scripts = $this->assets->loadScripts($script) . $this->scripts;
    }

    /**
     *  load general config
     */
    private function general() : void
    {
        $this->setAssets( new Assets );

        $this->addCss('reset');
        $this->addCss('general');

        $this->addJs('general');

        $this->setAssets( new AssetsCdn );
        $this->addCss('https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap');
        $this->addCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css');
    }
}
