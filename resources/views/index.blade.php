@extends('layouts.main')
@section('title','Add New')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h1 id="quote">User Records</h1>
                <button type="button" class="btn btn-outline-primary right" data-bs-toggle="modal" data-bs-target="#exampleModal">Add new</button>
            </div>
        </div>
        <div id="success_message"></div>
        <div class="table-responsive text-center">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Experience</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
            }
        });
        $(document).ready(function(){
            fetchEmp();
            function fetchEmp(){
                $.ajax({
                    type:'GET',
                    url:"{{ url('/fetchEmp') }}",
                    dataType:'json',
                    success:function(response){
                        $('tbody').html("");
                        $.each(response.user, function(key, item){
                            $('tbody').append(
                                '<tr>\
                                    <td><img src="'+item.emp.avatar+'" alt="" class="image"></td>\
                                    <td>'+item.emp.fname+'</td>\
                                    <td>'+item.emp.email+'</td>\
                                    <td>'+item.experience+'</td>\
                                    <td>\
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" id="edit_id" data-id="'+item.emp.id+'"><i class="fa-solid fa-pencil fss"></i>Edit</button>\
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeModal" id="del_id" data-id="'+item.emp.id+'"><i class="fa-solid fa-trash fss"></i>Delete</button>\
                                    </td>\
                                </tr>'
                            );
                        });
                    }
                });
            }
            $(document).on('click','#update_emp',function(e){
                e.preventDefault();
                var id = $('#edit_empid').val();
                var data = {
                        'fname' : $('#edit_fname').val(),
                        'email' : $('#edit_email').val(),
                        'join_date' : $('#edit_join').val(),
                        'leave_date' : $('#edit_leave').val(),
                        'status' : $('#edit_status').val(),
                        'avatar' : $('#edit_avatars').attr('src'),
                }
                $.ajaxSetup({
                        headers:{
                            'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
                        }
                    });
                $.ajax({
                        type:'PUT',
                        url:"{{ url('/update/') }}/"+id,
                        data:data,
                        dataType:"json",
                        success:function(response){
                            if(response.status == 404){
                                $('#success_message').html("");
                                $('#success_message').addClass("alert alert-danger");
                                $('#success_message').text(response.message);
                            }else{
                                $('#success_message').html("");
                                $('#success_message').addClass("alert alert-success");
                                $('#success_message').text(response.message);
                                $('#editModal').modal('hide');
                                fetchEmp();
                            }
                        }
                    })
            });
            $(document).on('click','#del_id', function(e){
                e.preventDefault();
                var id = $(this).data('id');
                $('#delete_id').val(id);
                $('#removeModal').modal('show');
            });

            $(document).on('click','#del_btn', function(e){
                e.preventDefault();
                var id = $('#delete_id').val();
                $.ajax({
                    type:'DELETE',
                    url:"{{ url('/delete/') }}/"+id,
                    success:function(response){
                        $('#success_message').html("");
                        $('#success_message').addClass("alert alert-success");
                        $('#success_message').text(response.message);
                        $('#removeModal').modal('hide');
                        fetchEmp();
                    }
                })
            });
            $(document).on('click','#edit_id', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#editModal').modal('show');
            $.ajax({
                type:"GET",
                url:"{{url('/edit/')}}/"+id,
                success:function(response){
                    console.log(response);
                    if(response.status==404){
                        $('#success_message').html("");
                        $('#success_message').addClass("alert alert-danger");
                        $('#success_message').text(response.message);
                    }else{
                        $('#edit_fname').val(response.employee.fname);
                        $('#edit_email').val(response.employee.email);
                        $('#edit_join').val(response.employee.join_date);
                        $('#edit_leave').val(response.employee.leave_date);
                        $('#edit_status').val(response.employee.status);
                        $('#edit_avatar').attr('src', response.employee.avatar);
                        $('#edit_empid').val(response.employee.id);
                        if(response.employee.status == 0){
                            $('#edit_leave').removeClass('d-none');
                            $('#edit_status').attr('checked', false);
                        }else{
                            $('#edit_status').attr('checked', true);
                        }
                    }
                }
            });
         });
        }); 
    </script>
@endsection