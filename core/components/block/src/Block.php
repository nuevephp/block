<?php

namespace Projectx\Block;

abstract class Block implements BlockInterface
{
    /**
     * @var \modX
     */
    protected $modx;

    function __construct(\modX $modx)
    {
        $this->modx = $modx;
    }
}