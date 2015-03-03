<?php

/**
 * Permet de tronquer un texte
 * @param $text
 * @param $limit
 * @return string
 */
function cut($text, $limit)
{
    return substr($text, 0, $limit) . "...";
}

/**
 * Formate une date en français
 * @param $date
 * @return string
 */
function dateToFr($date)
{
    $date = strtotime($date);
    $days = ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
    $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'];

    $d = $days[date('w',$date)];
    $dNb = date('j',$date);
    $m = $months[date('n',$date)];
    $y = date('Y',$date);

    return $d . " " . $dNb . " " . $m ." " . $y;
}