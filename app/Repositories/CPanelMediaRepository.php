<?php
/**
 * Laravella CMS
 * File: CPanelUserRepository.phpCreated by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */

namespace App\Repositories;

use App\Http\Models\Cpanel\CPanelMedia;

class CPanelMediaRepository extends BaseRepository
{
    public function __construct(CPanelMedia $model)
    {
        parent::__construct();
        $this->model = $model;
    }


    public function uploadMedia($request)
    {
        $result = false;
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('uploads/images/'), $imageName);

        $imageUpload = new CPanelMedia();
        $imageUpload->filename = $imageName;
        if($imageUpload->save()) $result = true;

        return $result;

    }


}