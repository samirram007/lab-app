 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('save-draft')}}">
            @csrf  
   
          <div class="modal-body bg-light">
            
            
              <div class="form-group">
                <label for="Code">Code</label>
                <input type="text" class="form-control" name="Code" id="Code" placeholder="" value="{{ $Code }}">
              </div>
              <div class="form-group">
                <label for="DraftID">DraftID</label>
                <input type="text" class="form-control" name="DraftID" id="DraftID" placeholder="DraftID" value="{{ $DraftID }}">
              </div>
              <div class="form-group">
                <label for="DraftNo">DraftNo</label>
                <input type="text" class="form-control" name="DraftNo" id="DraftNo" placeholder="DraftNo" value="{{ $DraftNo }}">
              </div>
              <div class="form-group">
                <label for="DraftData">DraftData</label>
                <input type="text" class="form-control" name="DraftData" id="DraftData" placeholder="DraftData" value="{{ $DraftData }}">
              </div>
              <div class="form-group">
                <label for="Origin">Origin</label>
                <input type="text" class="form-control" name="Origin" id="Origin" placeholder="Origin" value="{{ $Origin }}">
              </div>
              <div class="form-group">
                <label for="DraftDate">DraftDate</label>
                <input type="text" class="form-control" name="DraftDate" id="DraftDate" placeholder="DraftDate" value="{{ $DraftDate }}">
              </div>
              <div class="form-group">
                <label for="DraftEndDate">DraftEndDate</label>
                <input type="text" class="form-control" name="DraftEndDate" id="DraftEndDate" placeholder="DraftEndDate" value="{{ $DraftEndDate }}">
              </div>
               
              
           
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" class="form-control" name="MasterID" id="MasterID"  value="{{ $MasterID }}">
            <input type="hidden" class="form-control" name="MasterType" id="MasterType"  value="{{ $MasterType }}">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-light">Save changes</button>
          </div> 
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    {{-- </div> --}}
   
   
    
  
