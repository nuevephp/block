<?php

namespace Projectx\Block\Exceptions;

use Exception;

class BlockMissingException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}