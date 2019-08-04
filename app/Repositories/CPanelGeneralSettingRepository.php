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
    protected $model;


    public function __construct(GeneralSettings $model)
    {
        $this->model = $model;
    }

    public function update($updatedRequest, $id = 1)
    {

        try {
            $newData = $updatedRequest->except(['_token']);
            $this->model::first()->update($newData);
            $result = true;

        } catch (QueryException $e) {
            $result = $e->errorInfo;

        }

        return $result;
    }

    public function all()
    {
        $stored_settngs = $this->model::first();

        return $stored_settngs;
    }
}