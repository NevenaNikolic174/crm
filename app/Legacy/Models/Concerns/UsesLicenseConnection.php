<?php

namespace App\Legacy\Models\Concerns;

use App\Legacy\License\LicenseConnection;

trait UsesLicenseConnection
{
    public function getConnectionName(): ?string
    {
        return LicenseConnection::name();
    }
}
