<?php

namespace Climbx\Filesystem;

use Climbx\Filesystem\Exception\FileErrorException;

interface FileHelperInterface
{
    /**
     * Returns file content as array of lines.
     *
     * @param string $path
     *
     * @return array
     *
     * @throws FileErrorException
     */
    public function getContentAsArray(string $path): array;

    /**
     * @param string $path
     *
     * @return string
     *
     * @throws FileErrorException
     */
    public function getContentAsString(string $path): string;

    /**
     * @param string $path
     *
     * @return bool
     */
    public function isReadable(string $path): bool;
}
