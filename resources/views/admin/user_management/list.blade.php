<x-admin.layout>
    <x-slot name="title">User Management</x-slot>
    <x-slot name="heading">User Management</x-slot>
   


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4 class="card-title">Add User Management</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <input class="form-control"  name="name" type="text" placeholder="Enter Name">
                                    <span class="text-danger is-invalid name_err"></span>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="col-form-label" for="initial">Email Name <span class="text-danger">*</span></label>
                                    <input class="form-control"  name="email" type="text" placeholder="Enter Email">
                                    <span class="text-danger is-invalid email_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="initial">Password Name <span class="text-danger">*</span></label>
                                    <input class="form-control"  name="password" type="password" placeholder="Enter Password">
                                    <span class="text-danger is-invalid password_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="initial">Confirm Password <span class="text-danger">*</span></label>
                                    <input class="form-control"  name="cnf_pass" type="password" placeholder="Enter Confirm Password">
                                    <span class="text-danger is-invalid cnf_pass_err"></span>
                                </div>

                                <div class="col-md-4">
                                <label class="col-form-label" for="initial">User Role <span class="text-danger">*</span></label>
                                    <select class="form-control"  name="user_type">
                                        <option value="">--User Role--</option>
                                        <option value="2">User Admin</option>
                                        <option value="3">Sales Admin</option>
                                    </select>
                                    <span class="text-danger is-invalid  user_type_err"></span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        {{-- Edit Form --}}
        <div class="row" id="editContainer" style="display:none;">
            <div class="col">
                <form class="form-horizontal form-bordered" method="post" id="editForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit User Management</h4>
                        </div>
                        <div class="card-body py-2">
                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                            <div class="mb-3 row">
                            <div class="col-md-4">
                                    <label class="col-form-label" for="initial"> Name <span class="text-danger">*</span></label>
                                    <input class="form-control"  name="name" type="text" placeholder="Enter Name">
                                    <span class="text-danger is-invalid name_err"></span>
                                </div>
                               

                                <div class="col-md-4">
                                    <label class="col-form-label" for="initial">Email Name <span class="text-danger">*</span></label>
                                    <input class="form-control"  name="email" type="text" placeholder="Enter Email">
                                    <span class="text-danger is-invalid email_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="initial">Password  <span class="text-danger">*</span></label>
                                    <input class="form-control"  name="password" type="password" placeholder="Enter Password">
                                    <span class="text-danger is-invalid password_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="initial">Confirm Password <span class="text-danger">*</span></label>
                                    <input class="form-control"  name="cnf_pass" type="password" placeholder="Enter Confirm Password">
                                    <span class="text-danger is-invalid cnf_pass_err"></span>
                                </div>

                                <div class="col-md-4">
                                <label class="col-form-label" for="initial">User Role <span class="text-danger">*</span></label>
                                    <select class="form-control"  name="user_type">
                                        <option value="">--User Role--</option>
                                        <option value="2">User Admin</option>
                                        <option value="3">Sales Admin</option>
                                    </select>
                                    <span class="text-danger is-invalid  user_type_err"></span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="editSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                    <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th> Name</th>
                                        <th>Email</th>
                                        <th>User Role</th>
                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
                                @foreach($users as $row)
                                <?php
                                $user_type='';
                                  if($row->user_type == 2){
                                     $user_type = 'User Admin';
                                  }elseif($row->user_type == 3){
                                     $user_type = 'Sales Admin';
                                   }
                                     ?>
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$user_type}}</td>
                                            <td>
                                                <button class="edit-element btn text-secondary px-2 py-1" title="Edit User Management" data-id="{{$row->id}}"><i class="fas fa-edit" ></i></button>
                                                <button class="btn text-danger rem-element px-2 py-1" title="Delete User Management" data-id="{{$row->id}}"> <i class="fa fa-trash" aria-hidden="true"></i>  </button>
                                            </td>
                                        </tr>
                                  @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</x-admin.layout>



<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('user_management.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data)
            {
                // console.log(data); 
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('user_management.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });


     });
</script>


<!-- Edit -->
<script>
    $("#buttons-datatables").on("click", ".edit-element", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('user_management.edit', ":model_id") }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour();
                if (!data.error)
                {
                    $("#editForm input[name='edit_model_id']").val(data.userManagement.id);
                    $("#editForm input[name='name']").val(data.userManagement.name);
                    $("#editForm input[name='email']").val(data.userManagement.email);
                    $("#editForm input[name='user_type']").val(data.userManagement.user_type);
                    $("#editForm select[name='user_type']").val(data.userManagement.user_type).trigger('change');
                    $("#editForm select[name='user_type']").val();
                }
                else
                {
                    alert(data.error);
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                alert("Some thing went wrong");
            },
        });
    });
</script>

<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('user_management.update', ":model_id") }}";
            //
            $.ajax({
                url: url.replace(':model_id', model_id),
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data)
                {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2)
                        swal("Successful!", data.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('user_management.index') }}';
                            });
                    else
                        swal("Error!", data.error2, "error");
                },
                statusCode: {
                    422: function(responseObject, textStatus, jqXHR) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(responseObject.responseJSON.errors);
                    },
                    500: function(responseObject, textStatus, errorThrown) {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error occured!", "Something went wrong please try again", "error");
                    }
                }
            });

        });
    });
</script>

<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to delete this User Management?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "User Management"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('user_management.destroy', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_method': "DELETE",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        if (!data.error && !data.error2) {
                            swal("Success!", data.success, "success")
                                .then((action) => {
                                    window.location.reload();
                                });
                        } else {
                            if (data.error) {
                                swal("Error!", data.error, "error");
                            } else {
                                swal("Error!", data.error2, "error");
                            }
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Something went wrong", "error");
                    },
                });
            }
        });
    });
</script>


