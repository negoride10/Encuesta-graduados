<?php

class OspinaHTMLHelper
{

    public static function render($html, array $params)
    {
        $newHtml = $html;
        foreach ($params as $key => $value) {
            $newHtml = str_replace('{{' . $key . '}}', $value, $newHtml);
        }
        return $newHtml;
    }
}