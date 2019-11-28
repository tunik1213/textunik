<?php

function remove_html_comments($text)
{

    $text = preg_replace('/<!--.*-->/Us','',$text);
    $text = preg_replace('/^.*-->/Us', '', $text);
    $text = preg_replace('/<!.*$/Us', '', $text);

    return $text;
}

