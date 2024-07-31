<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/dt-2.1.0/datatables.min.css" rel="stylesheet">

    <title>Customer Table</title>
</head>
<body>
<h1 class="text-center">Customer Datatable</h1>
<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        Add User
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <table id="datatable" class="table">
                        <thead>
                        <tr>
                            <th>SNo.</th>
                            <th>Username</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.1.0/datatables.min.js"></script>
<script src="from.js"></script>

<!-- Modal for adding user -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Add user button form -->
            <form id="saveUserForm" action="javascript:void();" method="post">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputUsername" name="inputUsername">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" name="inputEmail">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputMobile" class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputMobile" name="inputMobile">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputCity" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputCity" name="inputCity">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add user modal end -->

<!-- Modal for editing user -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Update user button form -->
            <form id="updateUserForm" action="javascript:void();" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="trid" name="trid" value="">
                    <div class="mb-3 row">
                        <label for="_inputUsername" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="_inputUsername" name="_inputUsername">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="_inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="_inputEmail" name="_inputEmail">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="_inputMobile" class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="_inputMobile" name="_inputMobile">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="_inputCity" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="_inputCity" name="_inputCity">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit user modal end -->
</body>
</html>
