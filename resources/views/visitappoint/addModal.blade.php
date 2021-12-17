 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('save-visitappoint')}}">
            @csrf  
   
          <div class="modal-body bg-light">
            
            
              <div class="form-group">
                <label for="Code">Code</label>
                <input type="text" class="form-control" name="Code" id="Code" placeholder="" value="{{ $Code }}">
              </div>
              <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" name="Name" id="Name" placeholder="VisitAppoint Name" value="{{ $Name }}">
              </div>
              <div class="form-group">
                <label for="Charges">Charges</label>
                <input type="text" class="form-control" name="Charges" id="Charges" placeholder="Charges" value="{{ $Charges }}">
              </div>
              <div class="form-group">
                <label for="Active">Active</label>
                <input type="text" class="form-control" name="Active" id="Active" placeholder="Active" value="{{ $Active }}">
              </div>
              <div class="form-group">
                <label for="OutdoorDept">OutdoorDept</label>
                <input type="text" class="form-control" name="OutdoorDept" id="OutdoorDept" placeholder="OutdoorDept" value="{{ $OutdoorDept }}">
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
   
   
    
  