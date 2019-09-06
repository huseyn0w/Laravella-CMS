<?php

namespace App\Http\Controllers\CPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CPanelBaseController extends Controller
{
    protected $repository;

    protected $per_page = 10;
    protected $user;

    protected $result;


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

    protected function deleteAjax(int $id)
    {
        if($id <= 0){
            echo "ID should be integer and more than 0";
            return;
        }

        $result = $this->repository->delete($id);



        if($result){
            echo 'OK';
        }
        else{
            echo $result;
            echo "Problem";
        }

        return;
    }


    protected function delete($id)
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

    protected function edit($id)
    {
        $this->result = $this->repository->getBy('id', $id);

        if(!$this->result) abort(404);

    }

    protected function update($id, $data)
    {
        $this->result = $this->repository->update($id, $data);

        if(!$this->result) return back()->with('error', '-');

        return back()->with('message', " ");
    }

    protected function create($request)
    {
        $this->result = $this->repository->create($request);

        if(!$this->result) return back()->with('message', " ");
    }

}