<?php

namespace App\Controller;

use App\Exception\FileException;
use App\Service\FileGenerator;
use Exception;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AttachmentController extends AbstractController
{
    protected const PDF_FILE_KEY = 'pdfDocument';
    private FileUploader $fileLoader;
    private FileGenerator $fileGenerator;

    public function __construct(FileUploader $fileUploader, FileGenerator $fileGenerator)
    {
        $this->fileLoader = $fileUploader;
        $this->fileGenerator = $fileGenerator;
    }

    /**
     * @throws FileException
     * @throws Exception
     */
    public function __invoke(Request $request): Response
    {
        $pdfFile = $request->files->get(static::PDF_FILE_KEY);

        if (! $pdfFile) {
            throw new FileException('Try upload another file');
        }

        $pdfDocument = $this->fileLoader->upload($pdfFile);
        $pngDocument = $this->fileGenerator->move($this->fileLoader->getTargetDirectory().'/'.$pdfDocument);

        return new Response(
            json_encode([
                'pdf'  => $pdfDocument,
                'docs' => $pngDocument,
            ]),
            201
        );
    }
}
