<?php

namespace SVG\Attributes\PathData;

use SVG\Attributes\PathData\AbstractPathDataCommand;

class RelativeHorizontalLine extends AbstractPathDataCommand
{
    public function __construct(
        public float $dx
    ) {
    }

    public static function getNames(): array
    {
        return ['h'];
    }

    public function getName(): string
    {
        return 'h';
    }

    public function __toString(): string
    {
        return "{$this->getName()} {$this->dx}";
    }

    public function getY(): int
    {
        return $this->getPrevious()->getLastPoint()[1];
    }

    public function getX(): int
    {
        return $this->getPrevious()->getLastPoint()[0] + $this->dx;
    }

    public function getPoints(): array
    {
        return [[$this->getX(), $this->getY()]];
    }

    public function getLastPoint(): array
    {
        return $this->getPoints()[0];
    }
}
