<?php

class FilesManager
{
    const UPLOAD_DIR = __DIR__ . '/uploads/';
    public string $error = '';
    private array $files = [];

    public function __construct(array $files = [])
    {
        $this->files = $files;
        $this->createUploadDir();
    }

    private function createUploadDir(): void
    {
        if (!is_dir(self::UPLOAD_DIR)) {
            if (!mkdir(self::UPLOAD_DIR)) {
                $this->error = 'Не удалось создать директорию...';
            }
        }
    }

    public function saveToUploadDir(): bool
    {
        if (!$this->checkUploadErrors() || $this->error !== '') {
            return false;
        }

        foreach ($this->files as $file) {

            // тут бы вызвать метод изменения имени, проверки допустимости файла и возможно что-то еще, но будем думать что надо так ...

            if (!move_uploaded_file($file['tmp_name'], self::UPLOAD_DIR . $file['name'])) {
                $this->error = "Ошибка загрузки «" . $file['name'] . "».\n";
                return false;
            }
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

    public function getUploadedFiles(): array
    {
        return array_diff(scandir(self::UPLOAD_DIR), array('..', '.'));
    }

    public function deleteFile(string $filename): bool
    {
        if (!unlink(self::UPLOAD_DIR . $filename)) {
            $this->error = "Ошибка удаления «" . $filename . "».\n";
            return false;
        }
        return true;
    }
}