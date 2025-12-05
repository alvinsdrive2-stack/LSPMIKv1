<?php

namespace App\Services;

use setasign\Fpdi\Tcpdf\Fpdi;

class VerificationCheckboxService
{
    /**
     * Define checkbox field positions with coordinates
     */
    public static function getCheckboxPositions(): array
    {
        return [
            'gedung'      => [148,  67],
            'bangunan'    => [148,  76],
            'ruangan'     => [148,  83],
            'pendingin'   => [148,  90], // special case: also writes text
            'internet'    => [148,  97],
            'proyektor'   => [148, 104],
            'pc'          => [148, 111],
            'mejaasesor'  => [148, 119],
            'mejaasesi'   => [148, 128],
            'komunikasi'  => [148, 139],
            'dokumentasi' => [148, 146],
            'pulpen'      => [148, 153],
            'pensil'      => [148, 160],
            'tipex'       => [148, 167],
            'penghapus'   => [148, 174],
            'spidol'      => [148, 181],
            'penggaris'   => [148, 188],
            'hvs'         => [148, 195],
            'apd'         => [148, 202],
            'apk'         => [148, 209],
            'p3k'         => [148, 219],
            'rambu'       => [148, 226],
        ];
    }

    /**
     * Define praktik tools mapping
     */
    public static function getPraktikToolsMapping(): array
    {
        return [
            'theodolite' => ['Theodolite'],
            'meteran' => ['Meteran', 'Mistar/Meteran'],
            'penggaris' => ['Penggaris'],
            'waterpass' => ['Waterpass'],
            'autocad' => ['Autocad'],
            'perancah' => ['Perancah'],
            'bouwplank' => ['Bouwplank'],
            'patok' => ['Patok / Bench Mark'],
            'jidar' => ['Jidar'],
            'bandul' => ['Lot / Bandul', 'Lot'],
            'palu_karet' => ['Palu Karet'],
            'palu_besi' => ['Palu'],
            'tang_jepit' => ['Tang Jepit'],
            'tang_potong' => ['Tang Potong'],
            'gergaji_kayu' => ['Gergaji Kayu'],
            'gergaji_besi' => ['Gergaji Besi'],
            'gerinda' => ['Mesin Gerinda'],
            'pembengkok' => ['Alat Pembengkok Besi'],
            'pahat' => ['Pahat Kayu'],
            'obeng' => ['Obeng'],
            'cangkul' => ['Cangkul'],
            'sendok_semen' => ['Sendok Semen'],
            'ember' => ['Ember'],
            'pengerik' => ['Alat Pengerik / Kape', 'Kape/spatula'],
            'roll_cat' => ['Kuas Roll Cat'],
            'kuas_cat' => ['Kuas'],
            'nampan' => ['Nampan Cat'],
            'benang' => ['Benang'],
            'paku' => ['Paku'],
            'ampelas' => ['Ampelas', 'Kertas amplas'],
            'triplek' => ['Triplek'],
            'lakban' => ['Masking Tape / Lakban', 'Masking Tape'],
            'dempul' => ['Dempul'],
            'papan_applicator' => ['Papan Applicator'],
            'mesin_bor' => ['Mesin Bor'],
            'mesin_serut' => ['Mesin Serut'],
            'mesin_gergaji' => ['Mesin Gergaji'],
            'penggaris_siku' => ['Penggaris Siku'],
            'cat' => ['Cat'],
        ];
    }

    /**
     * Check if checkbox is actually checked from form data
     */
    public static function isCheckboxChecked($request, string $fieldName): bool
    {
        // Checkbox yang tidak dicentang tidak akan ada di request
        // Jadi kita harus cek apakah field tersebut exists dan equals "Yes"
        return isset($request->$fieldName) && $request->$fieldName === "Yes";
    }

    /**
     * Check if pendingin has value
     */
    public static function hasPendinginValue($request): bool
    {
        return isset($request->pendingin) && !empty($request->pendingin);
    }

    /**
     * Draw checkmarks for persyaratan jabatan kerja
     */
    public static function drawPersyaratanCheckmarks($fpdi, $request): void
    {
        $fieldPositions = self::getCheckboxPositions();

        foreach ($fieldPositions as $field => [$x, $y]) {
            $isChecked = ($field === 'pendingin')
                ? self::hasPendinginValue($request)
                : self::isCheckboxChecked($request, $field);

            if ($isChecked) {
                $fpdi->SetFont('dejavusans', '', 12);
                $fpdi->SetXY($x, $y);
                $fpdi->Write(0, "✓");
                $fpdi->SetXY($x + 28, $y);
                $fpdi->Write(0, "✓");

                // Special case: pendingin also writes text value
                if ($field === 'pendingin' && self::hasPendinginValue($request)) {
                    $fpdi->SetFont('Times', '', 10);
                    $fpdi->SetXY(99, 90);
                    $fpdi->Write(0, $request->pendingin);
                }
            }
            // Jika tidak dicentang, TIDAK melakukan apapun (ini yang salah di kode lama)
        }
    }

    /**
     * Draw checkmarks for praktik tools
     */
    public static function drawPraktikToolsCheckmarks($fpdi, $request, array $peralatanArray, int $startY = 233, int $lineSpacing = 7): void
    {
        $requestTools = self::getPraktikToolsMapping();
        $currentY = $startY;

        foreach ($peralatanArray as $peralatan) {
            foreach ($requestTools as $requestName => $peralatanNames) {
                $labels = (array) $peralatanNames;

                foreach ($labels as $label) {
                    if (self::isCheckboxChecked($request, $requestName) && strcasecmp(trim($peralatan), trim($label)) === 0) {
                        $fpdi->SetFont('dejavusans', '', 12);
                        $fpdi->SetXY(148, $currentY);
                        $fpdi->Write(0, "✓");
                        break 2; // Stop checking other labels for this peralatan
                    }
                }
            }
            $currentY += $lineSpacing;
        }
    }

    /**
     * Validate all required checkboxes are checked
     */
    public static function validateAllRequiredCheckboxes($request): bool
    {
        $requiredFields = array_keys(self::getCheckboxPositions());

        // Remove 'pendingin' from required checkbox validation since it's a select
        $requiredFields = array_diff($requiredFields, ['pendingin']);

        foreach ($requiredFields as $field) {
            if (!self::isCheckboxChecked($request, $field)) {
                return false;
            }
        }

        // Also check if pendingin has value
        if (!self::hasPendinginValue($request)) {
            return false;
        }

        return true;
    }

    /**
     * Get checkbox data from request for debugging
     */
    public static function getCheckboxData($request): array
    {
        $checkboxData = [];
        $allFields = array_keys(self::getCheckboxPositions());

        foreach ($allFields as $field) {
            if ($field === 'pendingin') {
                $checkboxData[$field] = $request->pendingin ?? null;
            } else {
                $checkboxData[$field] = self::isCheckboxChecked($request, $field) ? 'Yes' : 'No';
            }
        }

        return $checkboxData;
    }
}