<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function sendNotification(Request $request)
    {
        $phoneNumber = $request->input('phone');
        $message = $request->input('message');

        // Log the incoming request parameters
        Log::info("Received request to send notification", ['phone' => $phoneNumber, 'message' => $message]);

        // Define la URL del servidor Venom
        $venomServerUrl = 'http://localhost:3000/send-message';

        // Log the URL and the payload being sent to Venom server
        Log::info("Sending request to Venom server", ['url' => $venomServerUrl, 'payload' => ['phoneNumber' => $phoneNumber, 'message' => $message]]);

        // Haz una solicitud POST al servidor Venom
        try {
            $response = Http::post($venomServerUrl, [
                'phoneNumber' => $phoneNumber,
                'message' => $message,
            ]);

            // Log the response status and body
            Log::info("Received response from Venom server", ['status' => $response->status(), 'body' => $response->body()]);

            if ($response->successful()) {
                return response()->json(['message' => 'Notification sent!']);
            } else {
                return response()->json(['message' => 'Failed to send notification', 'error' => $response->body()], 500);
            }
        } catch (\Exception $e) {
            // Log the exception message
            Log::error("Exception caught while sending request to Venom server", ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to send notification', 'error' => $e->getMessage()], 500);
        }
    }
}
