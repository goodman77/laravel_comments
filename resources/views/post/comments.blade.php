@foreach($comments as $comment)

               <ul class="media-list">
                      <li class="media-replied">
                        <div class="media-body">
                          <div class="well well-lg">
                              <h4 class="media-heading text-uppercase reviews">{{$comment->owner->name}}</h4>
                              <ul class="media-date text-uppercase reviews list-inline">
                                <li class="dd">{{$comment->updated_at->diffForHumans()}}</li>
                              </ul>
                              <p class="media-comment">
                               {{$comment->comment}}
                              </p>
                              <a class="btn btn-info btn-circle text-uppercase" href="#replyCollapse-{{$comment->id}}" data-toggle="collapse" id="reply"><span class="glyphicon glyphicon-share-alt"></span> Reply</a>
                          </div>
                          
                         <div class="collapse" id="replyCollapse-{{$comment->id}}">
                         <div id="alert-{{ $comment->id }}" class="alert alert-danger hidden">
						</div>
                           <form method="post" class="form-horizontal laravelComment-form" data-parent="{{ $comment->id }}"  id="{{ $comment->id }}-reply-form" role="form">
                              <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                      <input class="form-control" name="name" id="{{ $comment->id }}-name" value="" pattern="[a-z]{1,15}"
        title="name should only contain lowercase letters. e.g. john" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comment"  class="col-sm-2 control-label">Comment</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" name="comment" id="{{ $comment->id }}-textarea" rows="5" pattern=".{3,250}" required title="3 to 250 characters" maxlength="250"  required ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">                    
                                        <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Summit comment</button>
                                    </div>
                                </div>            
                           </form>
                        </div>
                                        
                        </div>

                @if($comment->relationLoaded('allRepliesWithOwner'))
                    @include('post.comments', ['comments' => $comment->allRepliesWithOwner])
                @endif

                      </li>          
                    </ul> 
@endforeach