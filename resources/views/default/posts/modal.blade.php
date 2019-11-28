<?php
/**
 * Laravella CMS
 * File: modal.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 07.11.2019
 */
?>


<!-- Modal -->
<div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('default/modal.edit_comment')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('update_post_comment')}}" method="POST">
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <textarea id="comment-update-field" class="form-control mb-10" name="comment" placeholder="Comment" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Comment'" required=""></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="updated_comment_id" id="updated_comment_id" value="">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary update-comment">@lang('default/modal.update_comment_btn')</button>
                </div>
            </form>
        </div>
    </div>
</div>
