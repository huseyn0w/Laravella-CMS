<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Mail\ContactMail;
use App\Repositories\PageRepository;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactMail as ContactRequest;


class PagesController extends BaseController
{

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index($page_slug = "/")
    {

       $data = $this->repository->getBy('slug', $page_slug);

       if(empty($data->custom_fields)) return view('default/pages/'.$data->template, compact('data'));

       $custom_fields = json_decode($data->custom_fields, true);


       return view('default.pages.'.$data->template, compact('data', 'custom_fields'));
    }


    public function sendMail(ContactRequest $request)
    {
        $data = array(
            'first_name'      =>  $request->first_name,
            'last_name'      =>  $request->last_name,
            'subject'      =>  $request->subject,
            'email'      =>  $request->email,
            'message'   =>   $request->message
        );

        $contact_mail = get_contact_email();

        if(!$contact_mail) $contact_mail = env('CONTACT_EMAIL');

        Mail::to($contact_mail)->send(new ContactMail($data));


        return back()->with('success', 'Your message has been sent! We will get back to you soon, thank you!');
    }


    public function search()
    {
        return view('default.pages.search');
    }

    public function searchResult(SearchRequest $request, $count=1)
    {
        $searchData['query'] = $request->get('query');
        $searchData['type'] = $request->get('filter');
        $result = $this->repository->getSearchResult($request, $count);
        $searchData['result'] = $result;

        return view('default.pages.search', compact('searchData'));
    }



    public function paginatedResult($string, $filter, $page)
    {
        $searchData['query'] = $string;
        $searchData['type'] = $filter;
        $result = $this->repository->getPaginatedSearchResult($string, $filter, $page);
        $searchData['result'] = $result;

        return view('default.pages.search', compact('searchData'));
    }




}
