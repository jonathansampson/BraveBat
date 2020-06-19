  
<?php


if (!function_exists('community_link')) {
    function community_link($site, $community)
    {
        $lookups = [
            'reddit' =>  "https://www.reddit.com/r/",
            'telegram' =>  "https://t.me/",
            'youtube' =>  "https://www.youtube.com/",
            'twitter' =>  "https://twitter.com/",
        ];
        return $lookups[$site] . $community;
    }
}

if (!function_exists('community_name')) {
    function community_name($site, $community)
    {
        $lookups = [
            'reddit' =>  "r/",
            'telegram' =>  "",
            'youtube' =>  "",
            'twitter' =>  "@",
        ];
        return $lookups[$site] . $community;
    }
}

if (!function_exists('community_site_name')) {
    function community_site_name($site)
    {
        $lookups = [
            'reddit' =>  "Reddit",
            'telegram' =>  "Telegram",
            'youtube' =>  "Youtube",
            'twitter' =>  "Twitter",
        ];
        return $lookups[$site];
    }
}
