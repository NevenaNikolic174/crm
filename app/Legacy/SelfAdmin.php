<?php

namespace App\Legacy;

use App\Legacy\License\LicenseConnection;

final class SelfAdmin
{
    public static function getNacinOdobravanja(string $type = 'SENT'): object
    {
        return LicenseConnection::db()->table('odobrenje_nacin_odobravanja')
            ->where('modul', 'SELFADMIN')
            ->where('type', $type)
            ->first() ?? (object) ['tip_odobrenja' => 1];
    }
}
