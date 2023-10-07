<?php

use App\Models\Language;
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


/**get selected language from session  */

function getLanguage(): string
{
    if(session()->has('language')){
        return session('language');

    }else {
        try {
            $language = Language::where('default'  , 1)->first();
            setLanguage($language->lang);
            return  $language->lang;
        } catch (\Throwable $th) {
            setLanguage('en');

            return $language->lang;
        }

    }
}

function setLanguage(string $code): void
{
    session(['language' => $code]);
}


function jalaliDate($date)
{
    if( getLanguage() == 'fa'){

        echo verta($date)->format('%B  %d , %Y');
    }
    else {
            echo verta($date)->toCarbon()->format(' M  j  Y');
    }

}

function jalaliDateTime($date)
{
    if( getLanguage() == 'fa'){

        echo verta($date)->format('Y-n-j   H:i');
    }
    else {
            echo verta($date)->toCarbon()->format('Y-n-j   H:i');
    }

}
