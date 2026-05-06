<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\AiService;

class AiChat extends BaseController
{
    public function index()
    {
        $message = $this->request->getPost('message');
        $propertyId = $this->request->getPost('property_id');

        if (!$message) {
            return $this->response->setJSON(['error' => 'Message is required']);
        }

        $aiService = new AiService();
        $result = $aiService->getChatResponse($message, (int)$propertyId);

        return $this->response->setJSON($result);
    }
}
