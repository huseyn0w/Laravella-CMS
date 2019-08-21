<?php

namespace App\Http\Controllers\Cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CPanelBaseController extends Controller
{
    protected $repository;

    protected $users_per_page = 10;
    protected $user;

    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            if (!Auth::check()) {
                return redirect('/login');
            }
            $this->user = \Auth::user(); // you can access user id hereyou can access user id here

            return $next($request);
        });
    }

    protected function checkUserPermission($permissionName, $modelName)
    {
        if (Auth::user()->cannot($permissionName, $modelName)) return false;

        return true;

    }

    protected function redirectUnathorizedUser()
    {
        return redirect()->route('unathorized');
    }

    public function deleteAjax($id)
    {
        $result = $this->repository->delete($id);

        if($result){
            echo 'OK';
        }
        else{
            echo "Problem";
        }

        return;
    }


    public function delete($id)
    {
        $result = $this->repository->delete($id);

        if(($result)){
            $message = "green";
        }
        else{
            $message = "red";
        }

        return back()->with('message', $message);
    }

}
