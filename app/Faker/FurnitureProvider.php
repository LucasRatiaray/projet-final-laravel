<?php

namespace App\Faker;

use Faker\Provider\Base;

class FurnitureProvider extends Base
{
    protected static $furniture = [
        'Chaise',
        'Table de chevet',
        'Armoire',
        'Commode',
        'Canapé',
        'Bibliothèque',
        'Buffet',
        'Table basse',
        'Table à manger',
        'Lit',
        'Fauteuil',
        'Bureau',
        'Meuble TV',
        'Étagère',
        'Dressing',
        'Coiffeuse',
        'Console',
        'Pouf',
        'Tabouret',
    ];

    public static function meubleName()
    {
        return static::randomElement(static::$furniture);
    }
}
