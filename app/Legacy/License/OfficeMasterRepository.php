<?php

namespace App\Legacy\License;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

final class OfficeMasterRepository
{
    public function connection(): ConnectionInterface
    {
        return DB::connection((string) config('legacy.office_master_connection', 'office_master'));
    }

    /**
     * @return array<int, object>
     */
    public function getUserLicenses(string $username, ?int $licenseId = null): array
    {
        $query = $this->connection()->table('office_users')
            ->leftJoin('office_license', 'office_users.licenseID', '=', 'office_license.ID')
            ->select([
                'office_users.*',
                'office_license.ID as licenseID',
                'office_license.appCode',
                'office_license.DataBaseName',
                'office_license.DataBaseUser',
                'office_license.DataBasePassword',
                'office_license.DBHost',
                'office_license.TimeAvailabilityGroup',
                'office_license.login_2fa',
            ])
            ->where('office_users.userName', $username)
            ->where('office_users.userAcitve', 1);

        if ($licenseId !== null) {
            $query->where('office_users.licenseID', $licenseId);
        }

        return $query->get()->values()->all();
    }

    public function findOfficeUser(string $username): ?object
    {
        return $this->connection()->table('office_users')->where('userName', $username)->first();
    }

    public function findLicense(int $licenseId): ?object
    {
        return $this->connection()->table('office_license')->where('ID', $licenseId)->first();
    }

    /**
     * @return array<int, object>
     */
    public function backupPackageData(string $appCode): array
    {
        return $this->connection()->select(
            "SELECT org_update_office_licensepackage.*,
                    org_update_office_packagetype.packageName,
                    'Trenutno nedostupno' AS SubbscriberID,
                    'Trenutno nedostupno' AS ShortName,
                    ' ' AS StreetName,
                    ' ' AS StreetNumber,
                    ' ' AS municipalityName,
                    ' ' AS PostCode,
                    ' ' AS UniqueID,
                    ' ' AS RegisteredNumber
                FROM org_update_office_licensepackage
                LEFT JOIN org_update_office_license ON (org_update_office_licensepackage.licenseID = org_update_office_license.ID)
                LEFT JOIN org_update_office_packagetype ON (org_update_office_licensepackage.packageType = org_update_office_packagetype.ID)
                WHERE org_update_office_license.appCode = :app",
            ['app' => $appCode]
        );
    }

    /**
     * @return Collection<int, stdClass>
     */
    public function languagesInUse(): Collection
    {
        return $this->connection()->table('languages')->where('InUse', 'Y')->get();
    }
}
