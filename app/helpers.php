<?php

function remove_html_comments($text)
{

    $text = preg_replace('/<!--.*-->/Us','',$text);
    $text = preg_replace('/^.*-->/Us', '', $text);
    $text = preg_replace('/<!.*$/Us', '', $text);

    return $text;
}

function nouns_declension($num, $str_one, $str_two, $str_five)
{
    $num = $num%100;
    if ($num >= 5 && $num <= 20) {
        return $str_five;
    }

	$num = $num%10;
    if ($num == 1) {
        return $str_one;
    }

    if ($num >= 2 && $num <= 4){
        return $str_two;
	}

	return $str_five;
}

