@extends('layout.app')

@section('content') 
<div class="container">
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="comment-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#comments-logout" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Comments</h4></a></li>
            </ul>            
            <div class="tab-content">
                <div class="tab-pane active">                
                    <a class="btn btn-success btn-circle text-uppercase" href="#replyCollapse-0" data-toggle="collapse" id="reply"><span class="glyphicon glyphicon-share-alt"></span> Write Comment</a>
                    <div class="collapse" id="replyCollapse-0">
                         <div id="alert-0" class="alert alert-danger hidden">
						</div>
                           <form method="post" class="form-horizontal laravelComment-form" data-parent="0"  id="0-reply-form" role="form">
                              <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                      <input class="form-control" name="name" id="0-name" value="" pattern="[a-z]{1,15}"
        title="name should only contain lowercase letters. e.g. john" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comment"  class="col-sm-2 control-label">Comment</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" name="comment" id="0-textarea" rows="5" pattern=".{3,250}" required title="3 to 250 characters" maxlength="250"  required ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">                    
                                        <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Summit comment</button>
                                    </div>
                                </div>            
                           </form>
                        </div>
                    
                    @if($post->relationLoaded('parentComments'))
                        @include('post.comments', ['comments' => $post->parentComments])
                    @endif
                </div>
                </div>
            </div>
        </div>
	</div>
  </div>
  
  </div>
</div>
@endsection