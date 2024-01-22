
<?php


$messageError = [
    'status' => 403,
    'message' => 'No authorized'
];

echo json_encode($messageError,http_response_code(403));