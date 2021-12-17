 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('save-test')}}">
            @csrf  
   
          <div class="modal-body bg-light">
            
            
              <div class="form-group">
                <label for="Code">Code</label>
                <input type="text" class="form-control" name="Code" id="Code" placeholder="" value="{{ $Code }}">
              </div>
              <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" name="Name" id="Name" placeholder="Test Name" value="{{ $Name }}">
              </div>
              <div class="form-group">
                <label for="Alias">Alias</label>
                <input type="text" class="form-control" name="Alias" id="Alias" placeholder="Alias" value="{{ $Alias }}">
              </div>
              <div class="form-group">
                <label for="TestGroupID">TestGroupID</label>
                <input type="text" class="form-control" name="TestGroupID" id="TestGroupID" placeholder="TestGroupID" value="{{ $TestGroupID }}">
              </div>
              <div class="form-group">
                <label for="TestCategoryID">TestCategoryID</label>
                <input type="text" class="form-control" name="TestCategoryID" id="TestCategoryID" placeholder="TestCategoryID" value="{{ $TestCategoryID }}">
              </div>
              <div class="form-group">
                <label for="TestDuration">TestDuration</label>
                <input type="text" class="form-control" name="TestDuration" id="TestDuration" placeholder="TestDuration" value="{{ $TestDuration }}">
              </div>
              <div class="form-group">
                <label for="Charges">Charges</label>
                <input type="text" class="form-control" name="Charges" id="Charges" placeholder="Charges" value="{{ $Charges }}">
              </div>
              <div class="form-group">
                <label for="StartDate">StartDate</label>
                <input type="text" class="form-control" name="StartDate" id="StartDate" placeholder="StartDate" value="{{ $StartDate }}">
              </div>
              <div class="form-group">
                <label for="EndDate">EndDate</label>
                <input type="text" class="form-control" name="EndDate" id="EndDate" placeholder="EndDate" value="{{ $EndDate }}">
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
   
   
    
  
