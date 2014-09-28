<?php

class Comment extends \Projectx\Block\Block
{
    public function init(array $params = array(), Pimple\Container $c)
    {
        return $c['block']->make('comment', $c['chunkParser'], $params);
    }
}