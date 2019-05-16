<?php
namespace Zooroyal\MeetUpExample;

class FileReader
{

    /** @var string */
    private $path;

    /** @var resource|bool */
    private $handle;

    /**
     * Will return actual line of source code.
     *
     * @return null|string
     */
    public function readLine()
    {
        $result = null;

        if (!is_resource($this->handle)) {
            $this->handle = fopen(__FILE__, 'rb');
        }

        if (($line = fgets($this->handle)) !== false) {
            $result = $line;
        } else {
            fclose($this->handle);
        }

        return $result;
    }

    /**
     * Example method for fluent interface mocks.
     *
     * @return FileReader
     */
    public function setX() : FileReader
    {
        $this->path = true;

        return $this;
    }

    /**
     * Example method for fluent interface mocks.
     *
     * @return FileReader
     */
    public function setY() : FileReader
    {
        $this->fileName = true;

        return $this;
    }
}
