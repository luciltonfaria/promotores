<?php

function getGreeting() {
    $currentTime = now()->format('H:i:s');

    if ($currentTime >= '05:00:00' && $currentTime < '12:00:00') {
        return 'Bom dia';
    } elseif ($currentTime >= '12:00:00' && $currentTime < '18:00:00') {
        return 'Boa tarde';
    } else {
        return 'Boa noite';
    }
}
