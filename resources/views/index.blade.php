<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AJAX CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        body{
            background-color: black;
            color: aqua;
        }
        thead{
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            background-color: aqua;
        }
        tr:hover {background-color: coral;}

    </style>

</head>

<body>
    <div class="row m-3">
        <div class="col-sm-6">
            <h3>All Teacher</h3>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Institute</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="col-sm-4 m-5">
            <form method="POST" action="{{ route('storeTeacher') }}" id="addForm">
                @csrf
                <h3>Add New Teacher</h3>
                <div class="mb-3 col-sm-9">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" />
                    <span class="text-danger" id="nameError"></span>
                </div>
                <div class="mb-3 col-sm-9">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title"
                        placeholder="Job Position" />
                    <span class="text-danger" id="titleError"></span>
                </div>

                <div class="mb-3 col-sm-9">
                    <label for="institute" class="form-label">Institute</label>
                    <input type="text" name="institute" class="form-control" id="institute"
                        placeholder="Institute Name" />
                    <span class="text-danger" id="instituteError"></span>
                </div>

                <button type="submit" id="addbtn" onclick="addData()" class="btn btn-primary">
                    Add
                </button>
                   <button type="submit" id="updatebtn" onclick="updateData()" class="btn btn-primary">
                Update
            </button>
            </form>
         
            
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $("#addbtn").show();
            $("#updatebtn").hide();
        });
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        // get all data
        function allData() {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/teacher/all",
                success: function(response) {
                    var data = "";
                    $.each(response, function(key, value) {
                        data = data + "<tr>";
                        data = data + "<td>" + value.id + "</td>";
                        data = data + "<td>" + value.name + "</td>";
                        data = data + "<td>" + value.title + "</td>";
                        data = data + "<td>" + value.institute + "</td>";
                        data = data + "<td>";
                        data =
                            data +
                            "<button class='btn btn-sm btn-primary m-2' onclick='editData("+value.id+")'>Edit</button>";
                        data =
                            data +
                            "<button class='btn btn-sm btn-danger m-2'>Delete</button>";
                        data = data + "<td>";
                        data = data + "</tr>";
                    });
                    $("tbody").html(data);
                },
            });
        }
        allData();

        //clear data
        function clearData(){
            $('#name').val('');
            $('#title').val('');
            $('#institute').val('');
            $('#nameError').val('');
            $('#titleError').val('');
            $('#instituteError').val('');
            
        }
        // add data
        function addData() {
            var name = $("#name").val();
            var title = $("#title").val();
            var institute = $("#institute").val();

            $.ajax({
                type: "POST",
                data: {
                    name: name,
                    title: title,
                    institute: institute
                },
                url: "/teacher/store/",
                success: function(data) {
                    clearData();
                    allData();
                },
                error: function(error) {
                    console.log(error.responseJSON);
                    if (error.responseJSON && error.responseJSON.errors) {
                        if (error.responseJSON.errors.name) {
                            $('#nameError').text(error.responseJSON.errors.name);
                        }

                        if (error.responseJSON.errors.title) {
                            $('#titleError').text(error.responseJSON.errors.title);
                        }

                        if (error.responseJSON.errors.institute) {
                            $('#instituteError').text(error.responseJSON.errors.institute);
                        }
                    } else {
                        // Handle unexpected or generic errors here
                        // For example: $('#genericError').text('An unexpected error occurred.');
                    }
                }
            });
        }

        //edit data
         function editData(id){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/teacher/edit/"+id,
                success: function(data){
                    $("#addbtn").hide();
                    $("#updatebtn").show();

                    $('#name').val(data.name);
                    $('#title').val(data.title);
                    $('#institute').val(data.institute);
                    console.log(data);
                }
            })
         }
        //  update data
         function updateData(){
            var name = $("#name").val();
            var title = $("#title").val();
            var institute = $("#institute").val();

            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    name: name,
                    title: title,
                    institute: institute
                },
                url: "/teacher/update/"+id,
                success:function(data){
                    clearData();
                    allData()
                }
            })

         }
    </script>
</body>

</html>
