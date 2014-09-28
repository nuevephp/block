<?php namespace Projectx\Block\Parsers;

use Pimple\Container;

interface ParserInterface
{
    public function setPath($dirPath);
    public function run($blockName, array $params = [], Container $container = null);
}