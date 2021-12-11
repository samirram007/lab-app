  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
 
          <form method="post" action="{{ route('save-agency')}}">
 
            @csrf  
   
          <div class="modal-body bg-light">
            
            
              <div class="form-group">
                <label for="Code">Code</label>
 
                <input type="text" class="form-control" name="Code" id="Code" placeholder="" value="{{ $Code }}">
 
              </div>
              <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" name="Name" id="Name" placeholder="Agency Name" value="{{ $Name }}">
              </div>
              <div class="form-group">
                <label for="ContactNo">ContactNo</label>
                <input type="text" class="form-control" name="ContactNo" id="ContactNo" placeholder="ContactNo" value="{{ $ContactNo }}">
              </div>
              <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" name="Address" id="Address" placeholder="Address" value="{{ $Address }}">
              </div>
              <div class="form-group">
                <label for="CommissionDept">CommissionDept</label>
                <input type="text" class="form-control" name="CommissionDept" id="CommissionDept" placeholder="CommissionDept" value="{{ $CommissionDept }}">
              </div>
              <div class="form-group">
                <label for="Origin">Origin</label>
                <input type="text" class="form-control" name="Origin" id="Origin" placeholder="Origin" value="{{ $Origin }}">
              </div>               
              
           
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" class="form-control" name="UserID" id="UserID"  value="{{ $UserID }}">
            <input type="hidden" class="form-control" name="UserType" id="UserType"  value="{{ $UserType }}">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-light">Save changes</button>
          </div> 
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    {{-- </div> --}}
   
   
    
  
