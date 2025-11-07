<?php

namespace App\Enum;

enum AnimalStatus : string {
    case AVAILABLE = 'AVAILABLE';
    case RESERVED = 'RESERVED';
    case ADOPTED = 'ADOPTED';
    case UNAVAILABLE = 'UNAVAILABLE';
}

?>