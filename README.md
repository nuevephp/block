# Block Interface Component System #

Block allows inclusion of Snippets and Chunks.

## Installation (pre-transport-package) ##
1. Extract source in modX root
2. `cd` into block/core/components/block/ and run `composer install`
3. Create a system setting called `block.core_path` and point to `{base_path}block/core/components/block/`
4. Create snippet called `block` and point it to the static file block/core/components/block/elements/snippets/block.snippet.php
5. Copy `block/assets/components/block` to your asset directory `assets/components/`

## Usage ##

To call a block, call the snippet ``[[!block?name=`myBlockName`]]``

By default the snippet will use the `SnippetParser`, if you are parsing a chunk you will need to set type to chunk.

``[[!block?name=`myBlockName` &type=`chunk`]]``

There are a few demo blocks in block/assets/components/block/comments/

## Use with existing MODX snippets

To use with existing snippets your will need to wrap them into an annonymous function like below:

```php
<?php
return function ($container, $modx, $scriptProperties) {
    $name = $modx->getOption('title', $scriptProperties);

    return $name;
};
```

You can setup default values by passing them into the Closure:

```php
<?php
$defaults = ['title' => 'Test'];
return function ($container, $modx, $scriptProperties) use ($defaults) {
    $scriptProperties = array_merge($defaults, $scriptProperties);
    $name = $modx->getOption('title', $scriptProperties);

    return $name;
};
```

## TODO

1. Yaml Parser for html chunk files

### This plugin is inspired by one of Alan Pich unreleased project called xBlox.