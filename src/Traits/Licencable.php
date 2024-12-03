<?php

namespace Marvelous\Licence\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Marvelous\Licence\Licence;



//function createLicence($model)
//{
//
//    $startDate = Carbon::now();
//    $expires_at = Carbon::parse($startDate)->addMonth()->format('Y-m-d');
//
//    //
//    $data = json_encode([
//        'start_date' => $startDate,
//        'expires_at' => $expires_at,
//    ]);
//
//    $key = Str::random(16);
//    $licenceData = base64_encode($data);
//    DB::beginTransaction();
//    \Marvelous\Licence\Models\Licence::create(
//        [
//            'model_id' => $model->id,
//            'model' => get_class($model),
//            'licence_key' => $key,
//            'licence' => $licenceData,
//        ]
//    );
//
//}
trait Licencable
{
    public static function bootLicencable()
    {
        static::retrieved(function ($model) {
//            if ($model->isCreatingLicence) {
//                createLicence($model);
//            } else {
                Licence::checkLicence($model->id);
//            }
        });
    }

}
