<?php namespace Projectx\Block\Parsers;

use Pimple\Container;
use Projectx\Block\BlockInterface;
use Projectx\Block\FindFileTrait;

class ChunkParser implements ParserInterface
{
    use FindFileTrait;

    protected $blockDirectoryPath;

    public function setPath($dirPath)
    {
        $this->blockDirectoryPath = $dirPath;
    }

    public function run($blockName, array $params = [], Container $container = null)
    {
        $fileInfo = $this->findFile($this->blockDirectoryPath, $blockName, '.html');

        $blockFile = $fileInfo->getRealPath();

        if (!file_exists($blockFile)) {
            throw new \Exception("The file doesn't exist at that location: [$blockFile]");
        }

        return $this->getFileContents($blockFile);
    }

    private function getFileContents($blockFile)
    {
        return file_get_contents($blockFile);
    }
}