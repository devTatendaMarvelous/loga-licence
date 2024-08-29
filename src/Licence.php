<?php

namespace Marvelous\Licence;

use Carbon\Carbon;
use Marvelous\Licence\Models\Licence as LicenceModel;

class Licence
{

    public static function checkLicence():void
    {
        $is_licenced = config('loga-licence.is_licenced');

        if(!$is_licenced){

            return;
        }


        $licence = LicenceModel::first();
        if (!$licence) {
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
