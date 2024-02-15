<td>
  <div class="dropdown">
    <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton3">
      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal_{{ $id }}"><i class="feather icon-edit mr-2"></i>{{ __("Comment")}}</a>
    
      </div>
  </div>
</td>

<div class="modal fade" id="exampleModal_{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('rep.comment') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <textarea name="comment" class="form-control" placeholder="Comment" cols="30" rows="5">{{App\ReportProduct::whereId($id)->value('comment')}}</textarea>
            <input type="hidden" name="report_id" value="{{$id}}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Comment</button>
        </div>
      </form>
    </div>
  </div>
</div>