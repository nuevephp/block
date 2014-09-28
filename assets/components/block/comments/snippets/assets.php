<?php
/*
 * Register CSS and JS to load in head of website
 */
return function ($container, $modx, $scriptProperties)
{
    $link = $modx->getOption('link', $scriptProperties, '');

    if (empty($link)) {
        return false;
    }

    $links = explode(',', preg_replace('/\s+/', '', $link));

    foreach ($links as $lnk) {
        list($type, $lnk) = explode('||', $lnk);

        if ($type === 'css') {
            $modx->regClientCSS($lnk);
        }

        if ($type === 'js') {
            $modx->regClientScript($lnk);
        }
    }
};