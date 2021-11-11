<?php


namespace App\SessionMessage;


trait SessionMessage
{
    public function processStatus($message, $type)
    {
        return redirect()->back()->with('processStatus', ['type' => $type, 'message' => $message]);
    }
}
