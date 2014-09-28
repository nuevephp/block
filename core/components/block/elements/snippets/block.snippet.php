<?php
$corePath = $modx->getOption('block.core_path', null, $modx->getOption('core_path') . 'components/block/');
require $corePath . 'helpers.php';

/**@var \Projectx\Block\Hunk $block */
$block = $container['block'];
$blockPath = $modx->getOption('block.block_path', null, $modx->getOption('assets_path') . 'components/block/');
$block->setBlockPath($blockPath);

// Name must be set
if (!isset($name)) {
    $modx->log(modX::LOG_LEVEL_WARN, "[Block] Blocks snippet called without a block name!");
    return '';
};

$blockName = $modx->getOption('name', $scriptProperties);
$blockType = $modx->getOption('type', $scriptProperties);

// Push MODX to the front of the array
$scriptProperties = ['modx' => $modx] + $scriptProperties;

// Check if block exists
$guessParserType = $block->exists($blockName);
if ($guessParserType === false) {
    $modx->log(modX::LOG_LEVEL_WARN, "[Block] Failed to find block `$blockName`");
    echo $guessParserType . ' Failed';
    return '';
};

// Find Parser in container
/**@var Projectx\Block\Parsers\ParserInterface $parser */
$parser = isset($container[$blockType . 'Parser']) ? $container[$blockType . 'Parser'] : $container[$guessParserType];

return $block->make($blockName, $parser, $container, $scriptProperties);