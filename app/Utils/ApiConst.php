<?php

namespace App\Utils;

final class ApiConst
{
    public const URL="https://api.qrserver.com/v1/create-qr-code/?size=350x350&data=";
    public const NBRE_RETRAITS = 3; // Nombre de repas possible par migrant
    public const TOKEN_VALIDATION_TIME = 60*5;
}