<?php
/**
 * Laravella CMS
 * File: post_categories_list.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 31.08.2019
 */
?>

@extends('cpanel.core.index')
@push('extrastyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Categories</h4>
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
                                        <strong>Categories has been deleted</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>Some problem has been occured. Please try again later.</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if ($update_message = Session::get('category_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Category has been created successfully</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <form method="POST" action="{{route('cpanel_category_bulk_delete')}}">
                            @csrf
                            @method('DELETE')
                            <div class="select-cover">
                                <select id="inputState" name="categories_action"  class="form-control">
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
                                                   <input class="form-check-input" id="selectAll" name="allcategories" type="checkbox" >
                                                   <span class="form-check-sign"></span>
                                               </label>
                                           </div>
                                        </th>
                                        <th>№</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($category_count = 0)
                                @forelse($categories_list as $category)
                                    @php($category_count++)
                                    <tr>
                                        <td>
                                            @if($category->id !== 1)
                                            <div class="form-check">
                                                <label for="category_{{$category->id}}" class="form-check-label form-checkbox">
                                                    <input class="form-check-input categories-checkbox-input" id="category_{{$category->id}}" name="categories[]" type="checkbox" value="{{$category->id}}" >
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                                @else

                                            @endif
                                        </td>
                                        <td>{{$category_count}}</td>
                                        <td>
                                            {{$category->title}}
                                        </td>
                                        <td>
                                            <span class="user_actions">
                                            <a href="{{route('cpanel_edit_category', $category->id)}}" target="_blank">Edit</a>
                                            @if($category->id !== 1)
                                                <input type="hidden" class="deleted_category_id" value="{{$category->id}}" name="deleted_category_id">
                                                <button type="button" class="delete_category">Delete</button>
                                            @endif
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="7">No categories has been found</td>
                                @endforelse
                                </tbody>
                            </table>
                        </form>
                        <div class="col-md-12">
                            {{ $categories_list->links() }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('cpanel_add_new_category')}}" class="btn btn-info btn-fill pull-right">Add new category</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('finalscripts')
    <script src="{{asset('admin')}}/js/category.js"></script>
@endpush
