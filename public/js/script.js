$(function() {
// define the comment template to use, with inject variable
const Comment = ({ name, date, comment, id }) => `
					<ul class="media-list">
						<li class="media-replied">
						<div class="media-body">
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
                           <form method="post" class="form-horizontal laravelComment-form" data-parent="${id}"  id="${id}-reply-form" role="form">
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
                        </div>
                        </div>
                        </li>
                        </ul>`;

// intial ajax with token
  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    }
  });

// on comment submkt form 
$(document).on('submit','.laravelComment-form',function(event){
	event.preventDefault();

    var thisForm = $(this);
    var parent_id = $(this).data('parent');
    var comment = $('textarea#'+parent_id+'-textarea').val();
    var name = $('input#'+parent_id+'-name').val();

    $.ajax({
         method: "post",
         url: "/comment/add",
         data: {parent_id: parent_id, comment: comment, name: name},
         dataType: "json"
      })
      .done(function(msg){

      	// check for error messages
      	if(msg.error){
      		// show error message
      		$('#alert-'+parent_id).removeClass('hidden');
      		$.each(msg.error, function(key, value){
      			$('#alert-'+parent_id).append(value);
      		});
      	}
      	else
      	{
            // hide error if any
            $('#alert-'+parent_id).addClass('hidden');

	        $('#replyCollapse-'+parent_id).collapse('hide');

	        if(parent_id == 0){
	        	$([{ name: msg.name, date: msg.date, comment: msg.comment, id: msg.id }
			         
			  ].map(Comment).join('')).insertAfter($('#replyCollapse-0'));
	        }
	        else
	        {
				$([{ name: msg.name, date: msg.date, comment: msg.comment, id: msg.id }
				         
				  ].map(Comment).join('')).insertAfter( $(thisForm).closest(".media-replied").find('.media-body') );
	        }
	        
	        $('textarea#'+parent_id+'-textarea').val('');
	        $('input#'+parent_id+'-name').val('');
        }
      })
      .fail(function(msg){
        console.log(msg);
      });

    return false;
});

});