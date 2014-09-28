<?php namespace Projectx\Block; 

trait FindFileTrait 
{
    /**
     * @param $directoryPath
     * @param $fileName
     * @param null $ext
     * @return bool|\SplFileInfo
     */
    protected function findFile($directoryPath, $fileName, $ext = null)
    {
        $fileName = empty($ext) ? $fileName : $fileName . $ext;
        $dirIterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directoryPath));
        foreach ($dirIterator as $file => $pathObject) {
            if ($pathObject->isFile()) {
                $pathInfo = pathinfo($file);
                $basename = $pathInfo['filename'];
                if ($fileName === $basename . $ext) {
                    return $pathObject;
                }
            }
        }
        return false;
    }
}