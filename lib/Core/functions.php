<?php

/**
 * htmlspecialchars()の省略形
 */
function h($string){
    return htmlspecialchars($string);
}

/**
 * スネークケース→キャメルケースへ変換
 */
function toCamel($string) {
    return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
}

/**
 * キャメルケース→スネークケースへ変換
 */
function toSnake($string) {
    return strtolower(preg_replace('/[A-Z]/', '_$0', lcfirst($string)));
}
?>