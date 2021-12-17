 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('save-testcategory')}}">
            @csrf  
   
          <div class="modal-body bg-light">
            
            
              <div class="form-group">
                <label for="Code">Code</label>
                <input type="text" class="form-control" name="Code" id="Code" placeholder="" value="{{ $Code }}">
              </div>
              <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" name="Name" id="Name" placeholder="TestCategory Name" value="{{ $Name }}">
              </div>
              <div class="form-group">
                <label for="TestGroupID">TestGroupID</label>
                <input type="text" class="form-control" name="TestGroupID" id="TestGroupID" placeholder="TestGroupID" value="{{ $TestGroupID }}">
              </div>
              <div class="form-group">
                <label for="MethodArray">MethodArray</label>
                <input type="text" class="form-control" name="MethodArray" id="MethodArray" placeholder="MethodArray" value="{{ $MethodArray }}">
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
   
   
    
  
