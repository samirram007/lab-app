 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('save-booking')}}">
            @csrf  
   
          <div class="modal-body bg-light">
            
            
              <div class="form-group">
                <label for="Code">Code</label>
                <input type="text" class="form-control" name="Code" id="Code" placeholder="" value="{{ $Code }}">
              </div>
              <div class="form-group">
                <label for="RefDoctorID">RefDoctorID</label>
                <input type="text" class="form-control" name="RefDoctorID" id="RefDoctorID" placeholder="RefDoctorID" value="{{ $RefDoctorID }}">
              </div>
              <div class="form-group">
                <label for="BookingNo">BookingNo</label>
                <input type="text" class="form-control" name="BookingNo" id="BookingNo" placeholder="BookingNo" value="{{ $BookingNo }}">
              </div>
              <div class="form-group">
                <label for="BookingID">BookingID</label>
                <input type="text" class="form-control" name="BookingID" id="BookingID" placeholder="BookingID" value="{{ $BookingID }}">
              </div>
              <div class="form-group">
                <label for="PatientID">PatientID</label>
                <input type="text" class="form-control" name="PatientID" id="PatientID" placeholder="PatientID" value="{{ $PatientID }}">
              </div>
              <div class="form-group">
                <label for="AgencyID">AgencyID</label>
                <input type="text" class="form-control" name="AgencyID" id="AgencyID" placeholder="AgencyID" value="{{ $AgencyID }}">
              </div>
              <div class="form-group">
                <label for="Origin">Origin</label>
                <input type="text" class="form-control" name="Origin" id="Origin" placeholder="Origin" value="{{ $Origin }}">
              </div>
              <div class="form-group">
                <label for="BookingDate">BookingDate</label>
                <input type="text" class="form-control" name="BookingDate" id="BookingDate" placeholder="BookingDate" value="{{ $BookingDate }}">
              </div>
              <div class="form-group">
                <label for="CreatedAt">CreatedAt</label>
                <input type="text" class="form-control" name="CreatedAt" id="CreatedAt" placeholder="CreatedAt" value="{{ $CreatedAt }}">
              </div>
              <div class="form-group">
                <label for="ModifiedAt">ModifiedAt</label>
                <input type="text" class="form-control" name="ModifiedAt" id="ModifiedAt" placeholder="ModifiedAt" value="{{ $ModifiedAt }}">
              </div>
              <div class="form-group">
                <label for="CreatedBy">CreatedBy</label>
                <input type="text" class="form-control" name="CreatedBy" id="CreatedBy" placeholder="CreatedBy" value="{{ $CreatedBy }}">
              </div>
              <div class="form-group">
                <label for="ModifiedBy">ModifiedBy</label>
                <input type="text" class="form-control" name="ModifiedBy" id="ModifiedBy" placeholder="ModifiedBy" value="{{ $ModifiedBy }}">
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
   
   
    
  
