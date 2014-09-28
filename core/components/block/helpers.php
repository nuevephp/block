<?php
require 'vendor/autoload.php';

use Pimple\Container;

$container = new Container;
$container['block'] = function ($c) {
    return new Projectx\Block\Hunk();
};

$container['snippetParser'] = function () {
    return new \Projectx\Block\Parsers\SnippetParser();
};

$container['chunkParser'] = function () {
    return new \Projectx\Block\Parsers\ChunkParser();
};