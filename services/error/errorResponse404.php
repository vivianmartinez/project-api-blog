
<?php
require_once '../../services/json-response/json-response.php';

$messageError = [
    'error' => true,
    'status' => 404,
    'message' => 'Not found'
];

return JsonResponse::view($messageError,404);