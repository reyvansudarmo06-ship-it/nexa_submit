<?php

namespace App\Services;

use RuntimeException;
use ZipArchive;

class SubmissionTextExtractor
{
    public function extract(
        string $filePath,
        string $mimeType
    ): string {
        if (!file_exists($filePath)) {
            throw new RuntimeException(
                'File submission tidak ditemukan.'
            );
        }

        $extension = strtolower(
            pathinfo($filePath, PATHINFO_EXTENSION)
        );

        /*
        |--------------------------------------------------------------
        | FILE TEKS
        |--------------------------------------------------------------
        */

        $textExtensions = [
            'txt',
            'csv',
            'json',
            'xml',
            'html',
            'htm',
            'php',
            'js',
            'css',
            'py',
            'java',
            'c',
            'cpp',
            'h',
            'sql',
            'md',
            'blade.php',
        ];

        if (
            in_array($extension, $textExtensions, true)
            ||
            str_starts_with($mimeType, 'text/')
        ) {
            return trim(
                file_get_contents($filePath)
            );
        }

        /*
        |--------------------------------------------------------------
        | DOCX
        |--------------------------------------------------------------
        */

        if (
            $extension === 'docx'
            ||
            $mimeType ===
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ) {
            return $this->extractDocx($filePath);
        }

        /*
        |--------------------------------------------------------------
        | FALLBACK
        |--------------------------------------------------------------
        */

        return '';
    }

    protected function extractDocx(
        string $filePath
    ): string {
        $zip = new ZipArchive();

        if (
            $zip->open($filePath) !== true
        ) {
            throw new RuntimeException(
                'File DOCX tidak dapat dibuka.'
            );
        }

        $xml = $zip->getFromName(
            'word/document.xml'
        );

        $zip->close();

        if ($xml === false) {
            return '';
        }

        $xml = preg_replace(
            '/<\/w:p>/i',
            "\n",
            $xml
        );

        $xml = preg_replace(
            '/<[^>]+>/',
            '',
            $xml
        );

        return trim(
            html_entity_decode(
                $xml,
                ENT_QUOTES | ENT_XML1,
                'UTF-8'
            )
        );
    }
}