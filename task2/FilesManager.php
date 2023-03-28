<?php

class FilesManager
{
    const UPLOAD_DIR = __DIR__ . '/uploads/';

    public string $error = '';
    private array $files = [];

    public function __construct(array $files)
    {
        $this->files = $files;
        $this->createUploadDir();

    }

    private function createUploadDir(): void
    {
        if (!mkdir(self::UPLOAD_DIR)) {
            die('Не удалось создать директорию...');
        }
    }

    public function saveToUploadDir(): bool
    {
        if (!$this->checkUploadErrors()) {
            return false;
        }
        return true;
    }

    private function checkUploadErrors(): bool
    {
        foreach ($this->files as $file) {
            if ($file['error'] != '0') {
                $this->error = 'Не удалось загрузить файл. Код ошибки: ' . $file['error'];
                return false;
            } elseif (!file_exists($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
                $this->error = 'Не удалось загрузить файл. Попробуйте позже.';
                return false;
            }
        }

        return true;
    }
}