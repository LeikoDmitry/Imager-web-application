<?php

namespace App\Controller;

use App\Entity\Attachment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AttachmentPostActionController extends AbstractController
{
    protected const PDF_FILE_KEY = 'pdfDocument';

    public function __invoke(Attachment $attachment, Request $request): Attachment
    {
        $pdfFile = $request->files->get(static::PDF_FILE_KEY);
        $attachment->setName($request->get('name'));
        $attachment->setPath($pdfFile);
        if (! $pdfFile) {
            return $attachment;
        }
        return $attachment;
    }
}
