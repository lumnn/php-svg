<?php
namespace SVG\Nodes\Texts;

use SVG\Nodes\Structures\SVGFont;
use SVG\Nodes\SVGNodeContainer;
use SVG\Rasterization\SVGRasterizer;

/**
 * Represents the SVG tag 'text'.
 *
 * Usage:
 *
 * $svg = new \SVG\SVGImage(600, 400);
 *
 * $font = new \SVG\Nodes\Structures\SVGFont('openGost', 'OpenGostTypeA-Regular.ttf');
 * $svg->getDocument()->addChild($font);
 *
 * $svg->getDocument()->addChild(
 *   (new \SVG\Nodes\Texts\SVGText('hello', 50, 50))
 *     ->setFont($font)
 *     ->setSize(15)
 *     ->setStyle('stroke', '#f00')
 *     ->setStyle('stroke-width', 1)
 * );
 *
 */
class SVGText extends SVGNodeContainer
{
    const TAG_NAME = 'text';

    /**
     * @var SVGFont
     */
    private $font;

    public function __construct($text = '', $x = 0, $y = 0)
    {
        parent::__construct();
        $this->setValue($text);

        $this->setAttribute('x', $x);
        $this->setAttribute('y', $y);
    }

    public function rasterize(SVGRasterizer $rasterizer)
    {
        $paintOrder = $this->getComputedStyle('paint-order');
        if (!$paintOrder) {
            $this->setStyle('paint-order', 'stroke fill');
        }

        $rasterizer->render('text', array(
            'x'         => $this->getAttribute('x'),
            'y'         => $this->getAttribute('y'),
            'size'      => $this->getComputedStyle('font-size'),
            'text'      => $this->getValue(),
            'font_path' => $this->font->getFontPath(),
        ), $this);
    }

    /**
     * Set font
     *
     * @param SVGFont $font
     * @return $this
     */
    public function setFont(SVGFont $font)
    {
        $this->font = $font;
        $this->setStyle('font-family', $font->getFontName());
        return $this;
    }

    /**
     * Set font size
     *
     * @param $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->setStyle('font-size', $size);
        return $this;
    }
}
