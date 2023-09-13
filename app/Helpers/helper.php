<?php

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

