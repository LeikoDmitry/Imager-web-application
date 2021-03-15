<?php

namespace App\Service;

use App\Exception\FileException;
use App\Message\UploadFileMessage;
use Spatie\PdfToImage\Exceptions\PdfDoesNotExist;
use Spatie\PdfToImage\Exceptions\InvalidFormat;
use Symfony\Component\Messenger\MessageBusInterface;
use Spatie\PdfToImage\Pdf;

class FileGenerator
{
    private const DOCUMENT_TARGET_DIRECTORY = 'doc';
    private const DOCUMENT_FILE_EXTENSION = 'jpg';
    private string $targetDirectory;

    public function __construct(string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @throws FileException
     * @throws InvalidFormat
     */
    public function move(string $pdfFile): array
    {
        try {
            $uid = uniqid();
            $pdf = new Pdf($pdfFile);
            $pdf->setOutputFormat(static::DOCUMENT_FILE_EXTENSION);
            $pages = $pdf->getNumberOfPages();
            $pdf->saveAllPagesAsImages($this->getTargetDirectory(), $uid);
            $arrayPaths = [];
            foreach (range(1, $pages) as $number) {
                $arrayPaths[] = $uid.$number.'.'.static::DOCUMENT_FILE_EXTENSION;
            }
            return $arrayPaths;
        } catch (PdfDoesNotExist $e) {
            throw new FileException($e->getMessage());
        }
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory.'/'.static::DOCUMENT_TARGET_DIRECTORY;
    }

    public function getFileName(string $path): string
    {
        return basename($path);
    }
}
