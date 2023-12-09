<?php

function formatPhoneNumber($number) {
    if (preg_match('/^62/', $number)) {
        return $number;
    } elseif (preg_match('/^0/', $number)) {
        return '62' . substr($number, 1);
    } else {
        return '62' . $number;
    }
}