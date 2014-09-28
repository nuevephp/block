<?php namespace Projectx\Block\Parsers;

use Pimple\Container;
use Projectx\Block\BlockInterface;
use Projectx\Block\FindFileTrait;

class SnippetParser implements ParserInterface
{
    use FindFileTrait;

    protected $blockDirectoryPath;

    public function setPath($dirPath)
    {
        $this->blockDirectoryPath = $dirPath;
    }

    public function run($blockName, array $params = array(), Container $container = null)
    {
        $fileInfo = $this->findFile($this->blockDirectoryPath, $blockName, '.php');

        $blockFile = $fileInfo->getRealPath();

        if (!file_exists($blockFile)) {
            throw new \Exception("The file doesn't exist at that location: [$blockFile]");
        }

        // Is it a callable
        if (is_callable($callable = require $blockFile)) {
            return $this->runCallable($callable, $params, $container);
        }

        // Is this a class
        if (class_exists($blockName)) {
            return $this->runClass($blockName, $params, $container);
        }
        return false;
    }

    private function runCallable($callable, $params, Container $container = null)
    {
        $app = array_shift($params);
        return call_user_func($callable, $container, $app, $params);
    }

    private function runClass($className, $params, Container $container = null)
    {
        $app = array_shift($params);
        $snippetClass = new $className($app);
        if (!$snippetClass instanceof BlockInterface) {
            throw new \DomainException("The [$snippetClass] is not an instance of BlockInterface");
        }
        return $snippetClass->init($params, $container);
    }
}