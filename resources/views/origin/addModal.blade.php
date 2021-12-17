 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('save-origin')}}">
            @csrf  
   
          <div class="modal-body bg-light">
            
            
              <div class="form-group">
                <label for="Code">Code</label>
                <input type="text" class="form-control" name="Code" id="Code" placeholder="" value="{{ $Code }}">
              </div>
              <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" name="Name" id="Name" placeholder="Origin Name" value="{{ $Name }}">
              </div>
              <div class="form-group">
                <label for="ContactNo1">ContactNo1</label>
                <input type="text" class="form-control" name="ContactNo1" id="ContactNo1" placeholder="ContactNo1" value="{{ $ContactNo1 }}">
              </div>
              <div class="form-group">
                <label for="ContactNo2">ContactNo2</label>
                <input type="text" class="form-control" name="ContactNo2" id="ContactNo2" placeholder="ContactNo2" value="{{ $ContactNo2 }}">
              </div>
              <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" name="Address" id="Address" placeholder="Address" value="{{ $Address }}">
              </div>
              <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" class="form-control" name="Email" id="Email" placeholder="Email" value="{{ $Email }}">
              </div>
              <div class="form-group">
                <label for="DateOfFoundation">DateOfFoundation</label>
                <input type="text" class="form-control" name="DateOfFoundation" id="DateOfFoundation" placeholder="DateOfFoundation" value="{{ $DateOfFoundation }}">
              </div>
              <div class="form-group">
                <label for="CELicenseNo">CELicenseNo</label>
                <input type="text" class="form-control" name="CELicenseNo" id="CELicenseNo" placeholder="CELicenseNo" value="{{ $CELicenseNo }}">
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
   
   
    
  
