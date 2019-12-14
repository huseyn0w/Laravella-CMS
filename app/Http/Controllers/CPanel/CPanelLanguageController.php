<?php

namespace App\Http\Controllers\CPanel;

use App\Repositories\LocalizationRepository;


class CPanelLanguageController extends CPanelBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($lang)
    {
        $this->setLang($lang);
        return redirect()->route('cpanel_home');
    }




}
