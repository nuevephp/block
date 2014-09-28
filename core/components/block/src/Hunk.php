<?php
namespace Projectx\Block;

use Pimple\Container;
use Projectx\Block\Parsers\ParserInterface;

class Hunk
{
    use FindFileTrait;

    const DS = DIRECTORY_SEPARATOR;

    protected $modx;
    protected $blockPath;
    protected $dirNames = [
        'chunks' => 'chunks',
        'snippets' => 'snippets'
    ];

    function __construct($blockPath = null)
    {
        $this->blockPath = $blockPath;
    }

    public function exists($blockName)
    {
        $blockDirPath = $this->getBlockPath() . $blockName;

        // If directory exists start looking for chunk
        $chunkDir = $blockDirPath . self::DS . $this->dirNames['chunks'];
        if (is_dir($chunkDir)) {
            return 'chunkParser';
        }

        // If no chunk found look for snippet
        $snippetDir = $blockDirPath . self::DS . $this->dirNames['snippets'];
        if (is_dir($snippetDir)) {
            return 'snippetParser';
        }

        if ($this->findFile($this->getBlockPath(), $blockName)) {
            return 'snippetParser';
        }

        return false;
    }

    public function getBlockPath()
    {
        return $this->blockPath;
    }

    public function setBlockPath($blockPath)
    {
        $this->blockPath = $blockPath;
    }

    public function make($blockName, ParserInterface $parser, Container $container, $params)
    {
        // Get block directory
        $parser->setPath($this->getBlockPath());
        return $parser->run($blockName, $params, $container);
    }
}