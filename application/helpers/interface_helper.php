<?php


/**
 * ye matn migire va be andazeye limit string barmigardoone .. kholase
 * @param string $string
 * @param int $limit
 * @return string
 */
function excerpts($string , $limit = 255){
    return substr($string,0,$limit) . '...' ;
}