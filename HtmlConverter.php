<?php

namespace MaxBeckers\HtmlConverter;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class HtmlConverter
{
    /**
     * Format plaintext to html.
     *
     * @param string $string
     * @param bool   $force
     *
     * @return string
     */
    public function plainToHtml($string, $force = false)
    {
        if ($force || false === $this->isHtml($string)) {
            // define regex-pattern
            $searchRepalce = array(
                '#(^|[\n ])([\w]+?://[^ \"\n\r\t<]*)#is'                       => '\\1<a href="\\2" target="_blank">\\2</a>',
                '#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#is'                     => '\\1<a href="http://\\2" target="_blank">\\2</a>',
                '#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i' => '\\1<a href="mailto:\\2@\\3">\\2@\\3</a>',
            );

            // convert new Line to <br>, make links clickable and return content
            return preg_replace(array_keys($searchRepalce), array_values($searchRepalce), nl2br($string));
        } else {
            return $string;
        }
    }

    /**
     * Format html to plaintext.
     *
     * @param string $string
     * @param bool   $force
     *
     * @return string
     */
    public function htmlToPlain($string, $force = false)
    {
        if ($force || true === $this->isHtml($string)) {
            $string  = preg_replace("/(?:<li>(.+?)<\/li>)/", " - $1\n", $string);
            $order   = array('<br />', '<br>');
            $replace = "\n";
            $string  = str_replace($order, $replace, $string);

            return strip_tags($string);
        } else {
            return $string;
        }
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    private function isHtml($string)
    {
        preg_match("/<\/?\w+((\s+\w+(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?)+\s*|\s*)\/?>/", $string, $matches);
        if (count($matches) == 0) {
            return false;
        } else {
            return true;
        }
    }
}
