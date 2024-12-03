<?php

namespace Marvelous\Licence;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Marvelous\Licence\Models\Licence as LicenceModel;
use Marvelous\Licence\Services\ApiService;

class Licence
{

    public static function checkLicence($model_id=0): void
    {


        $is_licenced = config('loga-licence.is_licenced');

        if (!$is_licenced) {
            return;
        }

//        $licenceType = config('loga-licence.licence_type');
//
//        if (strtolower($licenceType) == 'api') {
//            $url = config('loga-licence.licence_app_url');
//            $appRef = config('loga-licence.app_ref');
//
//            $licence = ApiService::get("$url/api/get-licence/$appRef");
//
//            dd($licence);
//        } else {
//            $licence = LicenceModel::whereModelId($model_id)->first();
//
//        }
        $licence = LicenceModel::whereModelId($model_id)->first();

        $hasLicence = $licence->licence ?? null;

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
    public static function createLicence($model_id=0)
    {
        $startDate = Carbon::now();
        $expires_at = Carbon::parse($startDate)->addMonth()->format('Y-m-d');

        $data = json_encode([
            'start_date' => $startDate,
            'expires_at' => $expires_at,
        ]);

        $key = Str::random(16);

        $licenceData = base64_encode($data);

       return  \Marvelous\Licence\Models\Licence::create(
            [
                'model_id' => $model_id,
                'licence_key' => $key,
                'licence' => $licenceData,
            ]
        );
    }

}
