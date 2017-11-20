const Comment = ({ name, date, comment, id }) => `<li class="media-replied">
                          <div class="well well-lg">
                              <h4 class="media-heading text-uppercase reviews">${name}</h4>
                              <ul class="media-date text-uppercase reviews list-inline">
                                <li class="dd">${date}</li>
                              </ul>
                              <p class="media-comment">
                               ${comment}
                              </p>
                              <a class="btn btn-info btn-circle text-uppercase" href="#replyCollapse-${id}" data-toggle="collapse" id="reply"><span class="glyphicon glyphicon-share-alt"></span> Reply</a>
                          </div>
                          
                         <div class="collapse" id="replyCollapse-${id}">
                           <form action="#" method="post" class="form-horizontal laravelComment-form" data-parent="${id}"  id="${id}-reply-form" role="form">
                              <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                      <input class="form-control" name="name" id="${id}-name" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comment"  class="col-sm-2 control-label">Comment</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" name="comment" id="${id}-textarea" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">                    
                                        <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Summit comment</button>
                                    </div>
                                </div>            
                           </form>
                        </div>`;

$(document).on('submit', '.laravelComment-form', function(){
    var thisForm = $(this);
    var parent_id = $(this).data('parent');
    var comment = $('textarea#'+parent+'-textarea').val();
    var name = $('input#'+parent+'-name').val();
    var token = $('#token').val();
    $.ajax({
         method: "get",
         url: "/api/comment/add",
         data: { _token:token, parent_id: parent_id, comment: comment, name: name},
         dataType: "json"
      })
      .done(function(msg){
        
        $(thisForm).toggle('normal');

        $('#'+item_id+'-comment-'+parent).prepend([
         
         {name: msg.name, date: msg.date, comment: msg.comment, id: msg.id }
         
         ].map(Comment).join(''));
        
        $('textarea#'+parent+'-textarea').val('');
        $('input#'+parent+'-name').val('');
      })
      .fail(function(msg){
        alert(msg);
      });

    return false;
});