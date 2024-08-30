<?php

namespace Marvelous\Licence;

use Carbon\Carbon;
use Marvelous\Licence\Models\Licence as LicenceModel;
use Marvelous\Licence\Services\ApiService;

class Licence
{

    public static function checkLicence(): void
    {

        $is_licenced = config('loga-licence.is_licenced');

        if (!$is_licenced) {
            return;
        }

        $licenceType = config('loga-licence.licence_type');

        if (strtolower( $licenceType) == 'api') {
            $url = config('loga-licence.licence_app_url');
            $appRef = config('loga-licence.app_ref');

            $licence = ApiService::get("$url/api/get-licence/$appRef");

        } else {
            $licence = LicenceModel::first();

        }
$hasLicence = $licence->licence??null;

        if (!$hasLicence) {
            // License is invalid or expired, deny access
            abort(403, 'Application Licence Expired ');
        }


        $licenceData = json_decode(base64_decode($licence->licence), false);

        $date = Carbon::parse($licenceData->expires_at)->endOfDay();

        $today = Carbon::today()->endOfDay();

        if ($date->lessThan($today)) {
            $licence->delete();
            self::checkLicence();
        }
    }
}
