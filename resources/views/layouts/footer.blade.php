    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 40%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('formSubmit') }}" enctype="multipart/form-data" method="post" class="form-inline">
                        @csrf
                        <div class="form-group row mb-2">
                            <label class="form-label col-sm-3 col-form-label">Email :</label>
                            <div class="col-md-6">
                                <input type="email" name="email" id="email" placeholder="Email"
                                    class="form-control" value="" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="form-label col-sm-3 col-form-label">Full Name :</label>
                            <div class="col-md-6">
                                <input type="text" name="fname" id="fname" placeholder="Full Name"
                                    class="form-control" value="" required>
                                @if ($errors->has('fname'))
                                    <span class="text-danger">{{ $errors->first('fname') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="form-label col-sm-3 col-form-label">Date of Joining:</label>
                            <div class="col-md-6">
                                <input type="date" name="join_date" id="join_date" class="form-control"
                                    value="" required>
                                @if ($errors->has('join_date'))
                                    <span class="text-danger">{{ $errors->first('join_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="form-label col-sm-3 col-form-label">Date of Leaving:</label>
                            <div class="col-md-4">
                                <input type="date" name="leave_date" id="leave_date" class="form-control d-none"
                                    value="">
                                @if ($errors->has('leave_date'))
                                    <span class="text-danger">{{ $errors->first('leave_date') }}</span>
                                @endif
                            </div>
                            <div class="col-md-4 mt-1">
                                <input class="form-check-input" type="checkbox" value="1" id="status"
                                    name="status">
                                <label class="form-check-label" for="flexCheckChecked">still working</label>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="form-label col-sm-3 col-form-label">Upload image :</label>
                            <div class="col-md-6">
                                <input class="form-control" name="avatar" type="file" id="formFile" required>
                                @if ($errors->has('avatar'))
                                    <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                @endif
                            </div>
                        </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" id="insert_data" class="btn btn-outline-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 40%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" enctype="multipart/form-data" id="updateForm" method="post" class="form-inline">
                        @csrf
                        <input type="hidden" name="edit_id" id="edit_empid">
                        <div class="form-group row mb-2">
                            <label class="form-label col-sm-3 col-form-label">Email :</label>
                            <div class="col-md-6">
                                <input type="email" name="email" id="edit_email" placeholder="Email"
                                    class="form-control" value="">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="form-label col-sm-3 col-form-label">Full Name :</label>
                            <div class="col-md-6">
                                <input type="text" name="fname" id="edit_fname" placeholder="Full Name"
                                    class="form-control" value="">
                                @if ($errors->has('fname'))
                                    <span class="text-danger">{{ $errors->first('fname') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="form-label col-sm-3 col-form-label">Date of Joining:</label>
                            <div class="col-md-6">
                                <input type="date" name="join_date" id="edit_join" class="form-control"
                                    value="">
                                @if ($errors->has('join_date'))
                                    <span class="text-danger">{{ $errors->first('join_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="form-label col-sm-3 col-form-label">Date of Leaving:</label>
                            <div class="col-md-4">
                                <input type="date" name="leave_date" id="edit_leave" class="form-control"
                                    value="" >
                                @if ($errors->has('leave_date'))
                                    <span class="text-danger">{{ $errors->first('leave_date') }}</span>
                                @endif
                            </div>
                            <div class="col-md-4 mt-1">
                                <input class="form-check-input" type="checkbox" value="1" id="edit_status"
                                    name="status">
                                <label class="form-check-label" for="flexCheckChecked">still working</label>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="form-label col-sm-3 col-form-label">Upload image :</label>
                            <div class="col-md-6">
                                <input class="form-control" name="avatar" type="file" id="edit_avatars">
                                @if ($errors->has('avatar'))
                                    <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <img src="" alt="" id="edit_avatar" style="height: 50px;width:50px;">
                            </div>
                        </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="update_emp" class="btn btn-outline-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit modal --}}
    <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-body">
                  <h5 class="modal-title text-center" id="exampleModalLabel">Are you sure you want to delete?</h5>
                    <div class="text-center">
                        <input type="hidden" name="" id="delete_id">
                        <button class="btn btn-danger" id="del_btn">Yes</button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- jQuery CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
             $("#status").click(function() {
                $('#status').attr('checked', false);
                $('#leave_date').removeClass('d-none');
              });
         });
         if( $('#status').attr('checked', true) ){
                $('#leave_date').addClass('d-none');
            }else{
                $('#status').attr('checked', false);
                $('#leave_date').removeClass('d-none');
            }
    </script>
    </body>

    </html>
