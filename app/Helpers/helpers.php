<?php


function jalaliDate($date = 'today', $format = '%A, %d %B %y')
{
    return Morilog\Jalali\Jalalian::forge($date)->format($format);
}
