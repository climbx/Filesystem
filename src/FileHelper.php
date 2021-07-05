<?php

namespace Climbx\Filesystem;

use Climbx\Filesystem\Exception\FileErrorException;

class FileHelper implements FileHelperInterface
{
    /**
     * @param string $path
     *
     * @return array
     *
     * @throws FileErrorException
     */
    public function getContentAsArray(string $path): array
    {
        $this->checkFilePath($path);

        return file($path, FILE_IGNORE_NEW_LINES);
    }

    /**
     * @param string $path
     *
     * @return string
     *
     * @throws FileErrorException
     */
    public function getContentAsString(string $path): string
    {
        $this->checkFilePath($path);

        return file_get_contents($path);
    }

    /**
     * @param string $path
     *
     * @throws FileErrorException
     */
    private function checkFilePath(string $path): void
    {
        if (!$this->isReadable($path)) {
            throw new FileErrorException("The file '$path' do not exists or has no read access.");
        }
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function isReadable(string $path): bool
    {
        return is_readable($path);
    }
}
