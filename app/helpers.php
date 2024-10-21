<?php
if (! function_exists('response_format')) {
    function response_format($message, $data, $success, $status)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'success' => $success
        ], $status);
    }
}
