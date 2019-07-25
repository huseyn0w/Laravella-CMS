<?php
/**
 * Laravella CMS
 * File: CPanelGeneralSettingRepository.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 25.07.2019
 */

namespace App\Repositories;


use App\Http\Models\GeneralSettings;
use Illuminate\Database\QueryException;

class CPanelGeneralSettingRepository extends BaseRepository
{
    public function saveSettings($newData)
    {

        $stored_settngs = GeneralSettings::first();

        try {

            $stored_settngs->update($newData);
            $result = true;

        } catch (QueryException $e) {

            $result = $e->errorInfo;

        }


        return $result;
    }

    public function getAllSettings()
    {
        $stored_settngs = GeneralSettings::first();

        return $stored_settngs;
    }
}