
<?php
require_once '../../services/json-response/json-response.php';

$messageError = [
    'error' => true,
    'status' => 403,
    'message' => 'No authorized'
];

return JsonResponse::view($messageError,403);