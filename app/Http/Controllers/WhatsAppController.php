<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


    

use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function sendWhatsAppMessage()
    {
        $twilioSid = config('app.twilio_sid');
        $twilioToken = config('app.twilio_auth_token');
        $twilioWhatsAppNumber = config('app.twilio_whatsapp_number');
        $recipientNumber = 'RECIPIENT_PHONE_NUMBER'; // Replace with the recipient's phone number in WhatsApp format (e.g., "whatsapp:+1234567890")
        $message = "Hello from Twilio WhatsApp API in Laravel! 🚀";

        $twilio = new Client($twilioSid, $twilioToken);

        try {
            $message = $twilio->messages->create(
                "whatsapp:$recipientNumber", // to
                [
                "from" => "whatsapp:$twilioWhatsAppNumber",
                "body" => $message,
                ]
                );

            return response()->json(['message' => 'WhatsApp message sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

