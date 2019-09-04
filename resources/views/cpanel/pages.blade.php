<?php
/**
 * Laravella CMS
 * File: pages.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 16.08.2019
 */
?>

@extends('cpanel.index')
@push('extrastyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Pages</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        @if ($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if ($update_message = Session::get('message'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Pages has been deleted</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>Some problem has been occured. Please try again later.</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if ($update_message = Session::get('page_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Page has been created successfully</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <form method="POST" action="{{route('cpanel_pages_bulk_delete')}}">
                            @csrf
                            @method('DELETE')
                            <div class="select-cover">
                                <select id="inputState" name="pages_action" required="" class="form-control">
                                    <option selected="selected">Bulk action</option>
                                    <option value="delete">Delete</option>
                                </select>
                                <button type="submit" class="btn btn-info btn-fill">Apply</button>
                            </div>
                            <table class="table table-hover table-striped users-table">
                                <thead>
                                    <tr>
                                        <th>
                                           <div class="form-check">
                                               <label for="selectAll" class="form-check-label form-checkbox">
                                                   <input class="form-check-input" id="selectAll" name="allusers" type="checkbox" >
                                                   <span class="form-check-sign"></span>
                                               </label>
                                           </div>
                                        </th>
                                        <th>№</th>
                                        <th>Name</th>
                                        <th>Author</th>
                                        <th>Publish date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($pages_count = 0)
                                @forelse($pages_list as $page)
                                    @php($pages_count++)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label for="page_{{$page->id}}" class="form-check-label form-checkbox">
                                                    <input class="form-check-input users-checkbox-input" id="page_{{$page->id}}" name="pages[]" type="checkbox" value="{{$page->id}}" >
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{$pages_count}}</td>
                                        <td>
                                            {{$page->title}}

                                            <span class="user_actions">
                                             @if (Auth::user()->can('manage_users', 'App\Http\Models\Page'))
                                                <a href="{{route('cpanel_edit_page', $page->id)}}" target="_blank">Edit</a>
                                                <input type="hidden" class="deleted_page_id" value="{{$page->id}}" name="deleted_page_id">
                                                <button type="button" class="delete_page">Delete</button>
                                             @endif
                                            </span>

                                        </td>
                                        <td>{{$page->author->username}}</td>
                                        <td>{{$page->created_at}}</td>
                                        <td>{{$page->status == 1 ? 'published' : 'private'}}</td>
                                    </tr>
                                @empty
                                    <td colspan="7">No pages has been found</td>
                                @endforelse
                                </tbody>
                            </table>
                        </form>
                        <div class="col-md-12">
                            {{ $pages_list->links() }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('cpanel_add_new_page')}}" class="btn btn-info btn-fill pull-right">Add new page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
