<?php

use PhpParser\Node\Expr\Cast\String_;

/**format news tags */

function formatTags(array $tags):string
{
    return implode(',' , $tags);
}

/**truncate text */
function truncate(string $text ,int $limit= 100) :string
{
    return \Str::limit($text, $limit, '...');
}


/**convert a number in k format  */

function convertToKFromant(int $number) : String
{
    if($number < 1000)
    {
        return $number;

    }elseif($number < 1000000)
    {
        return round($number / 1000 , 1) . 'K'; // 5.K
    }else
    {
        return round($number / 1000000 ,1) . 'M'; // 5.M
    }
}
