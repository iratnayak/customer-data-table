<?php
include('connection.php');

$request = $_POST;

$columns = array(
    0 => 'id',
    1 => 'username',
    2 => 'mobile',
    3 => 'email',
    4 => 'city'
);

// Initial query
$sql = "SELECT * FROM users";
$query = mysqli_query($con, $sql);
$count_all_row = mysqli_num_rows($query);

$sql = "SELECT * FROM users WHERE 1=1";

// Search functionality
if(!empty($request['search']['value']))
{
    $search_value = $request['search']['value'];
    $sql .= " AND (username LIKE '%".$search_value."%' ";
    $sql .= " OR mobile LIKE '%".$search_value."%' ";
    $sql .= " OR email LIKE '%".$search_value."%' ";
    $sql .= " OR city LIKE '%".$search_value."%' )";
}

// Order functionality
if(isset($request['order']))
{
    $column = $request['order'][0]['column'];
    $order = $request['order'][0]['dir'];
    $sql .= " ORDER BY ".$columns[$column]." ".$order; 
}
else
{
    $sql .= " ORDER BY id ASC";
}

// Pagination
if($request['length'] != -1)
{
    $start = $request['start'];
    $length = $request['length'];
    $sql .= " LIMIT ".$start.", ".$length;
}

$data = array();
$run_query = mysqli_query($con, $sql);
$filtered_row = mysqli_num_rows($run_query);

while($row = mysqli_fetch_assoc($run_query))
{
    $subarray = array();
    $subarray[] = $row['id'];
    $subarray[] = $row['username'];
    $subarray[] = $row['mobile'];
    $subarray[] = $row['email'];
    $subarray[] = $row['city'];
    $subarray[] = '<a href="javascript:void(0)" data-id="'.$row['id'].'" class="btn btn-sm btn-info editBtn">Edit</a>
                    <a href="javascript:void(0)" data-id="'.$row['id'].'" class="btn btn-sm btn-danger deleteBtn">Delete</a>';
    $data[] = $subarray;
}

$output = array(
    'draw' => intval($request['draw']),
    'recordsTotal' => $count_all_row,
    'recordsFiltered' => $filtered_row,
    'data' => $data,
);

echo json_encode($output);
?>
