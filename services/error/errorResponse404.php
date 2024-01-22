
<?php


$messageError = [
    'status' => 404,
    'message' => 'Not found'
];

echo json_encode($messageError,http_response_code(404));