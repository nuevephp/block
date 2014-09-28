<?php

namespace Projectx\Block;

use Pimple\Container;

interface BlockInterface
{
    public function init(array $params = array(), Container $c);
}