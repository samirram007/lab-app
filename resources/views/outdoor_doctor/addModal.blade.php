 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('save-customer')}}">
            @csrf  
   
          <div class="modal-body bg-light">
            
            
              <div class="form-group">
                <label for="Code">Code</label>
                <input type="text" class="form-control" name="Code" id="Code" placeholder="P0" value="{{ $Code }}">
              </div>
              <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" name="Name" id="Name" placeholder="Customer Name" value="{{ $Name }}">
              </div>
              <div class="form-group">
                <label for="ContactNo">ContactNo</label>
                <input type="text" class="form-control" name="ContactNo" id="ContactNo" placeholder="ContactNo" value="{{ $ContactNo }}">
              </div>
              <div class="form-group">
                <label for="DoctorType">DoctorType</label>
                <input type="text" class="form-control" name="DoctorType" id="DoctorType" placeholder="DoctorType" value="{{ $DoctorType }}">
              </div>
              <div class="form-group">
                <label for="Degree">Degree</label>
                <input type="text" class="form-control" name="Degree" id="Degree" placeholder="Degree" value="{{ $Degree }}">
              </div>
              <div class="form-group">
                <label for="Registration_No">Registration_No</label>
                <input type="text" class="form-control" name="Registration_No" id="Registration_No" placeholder="Registration_No" value="{{ $Registration_No }}">
              </div>
              <div class="form-group">
                <label for="Chamber">Chamber</label>
                <input type="text" class="form-control" name="Chamber" id="Chamber" placeholder="Chamber" value="{{ $Chamber }}">
              </div>
              <div class="form-group">
                <label for="ChamberStartDate">ChamberStartDate</label>
                <input type="text" class="form-control" name="ChamberStartDate" id="ChamberStartDate" placeholder="ChamberStartDate" value="{{ $ChamberStartDate }}">
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
   
   
    
  