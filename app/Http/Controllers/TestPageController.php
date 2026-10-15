<?php

namespace App\Http\Controllers;

use App\Legacy\License\LicenseConnection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class TestPageController extends Controller
{
    public function __invoke(): View
    {
        $despatchAdvices = LicenseConnection::db()->table('despatch_advices')
            ->select(['despatchAdviceNumber', 'issueDate', 'status'])
            ->orderByDesc('issueDate')
            ->get();

        $subjectOwnerSeo = DB::connection('office_master')->table('sa_subject_owner_seo')
            ->orderByDesc('id')
            ->get();

        return view('pages.test', [
            'tables' => [
                $this->table('otpremnice', 'Otpremnice', $despatchAdvices, [
                    'despatchAdviceNumber' => 'Broj otpremnice',
                    'issueDate' => 'Datum izdavanja',
                    'status' => 'Status',
                ], [[1, 'desc']]),
                $this->table('subjekti', 'Subjekti', $subjectOwnerSeo, [], [[0, 'desc']]),
            ],
        ]);
    }

    private function table(string $id, string $title, Collection $rows, array $columns, array $order): array
    {
        $data = [];

        foreach ($rows as $row) {
            $data[] = (array) $row;
        }

        if ($columns === []) {
            $keys = array_keys($data[0] ?? []);
            $columns = array_combine($keys, $keys);
        }

        return [
            'id' => $id,
            'title' => $title,
            'columns' => $columns,
            'rows' => $data,
            'order' => $order,
        ];
    }
}
