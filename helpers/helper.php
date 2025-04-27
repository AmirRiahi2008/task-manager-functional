<?php
function site_uri($uri = '')
{
    return $_ENV["BASE_URL"] . $uri;
}
function niceDump($inp)
{
    echo "<pre>";
    var_dump($inp);
    echo "</pre>";
}
function redirect($path = '')
{
    header("Location:" . site_uri($path));
}
function error404()
{
    header("HTTP/1.0 404 Not Found");
    die();
}
