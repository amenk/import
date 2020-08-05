<?php

/**
 * TechDivision\Import\Adapter\LeagueFilesystemAdapter
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Adapter;

use League\Flysystem\FilesystemInterface;

/**
 * Adapter for the league filesystem implementation.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */
class LeagueFilesystemAdapter implements FilesystemAdapterInterface
{

    /**
     * The league filesystem implementation.
     *
     * @var \League\Flysystem\FilesystemInterface
     */
    protected $filesystem;

    /**
     * This is a utility class, so protect it against direct
     * instantiation.
     *
     * @param \League\Flysystem\FilesystemInterface $filesystem The league filesystem instance
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Creates a new directroy.
     *
     * @param string  $pathname The directory path
     * @param integer $mode     The mode is 0700 by default, which means the widest possible access
     *
     * @return boolean TRUE on success, else FALSE
     */
    public function mkdir($pathname, $mode = 0755)
    {
        return $this->filesystem->createDir($pathname, array('visibility' => $mode === 0755 ? 'public' : 'private'));
    }

    /**
     * Query whether or not the passed filename exists.
     *
     * @param string $filename The filename to query
     *
     * @return boolean TRUE if the passed filename exists, else FALSE
     */
    public function isFile($filename)
    {
        return $this->filesystem->has($filename);
    }

    /**
     * Tells whether the filename is a directory.
     *
     * @param string $filename Path to the file
     *
     * @return TRUE if the filename exists and is a directory, else FALSE
     */
    public function isDir($filename)
    {
        return $this->filesystem->has($filename);
    }

    /**
     * Creates an empty file with the passed filename.
     *
     * @param string $filename The name of the file to create
     *
     * @return boolean TRUE if the file can be created, else FALSE
     */
    public function touch($filename)
    {
        return $this->filesystem->put($filename, '');
    }

    /**
     * Renames a file or directory.
     *
     * @param string $oldname The old name
     * @param string $newname The new name
     *
     * @return boolean TRUE on success, else FALSE
     */
    public function rename($oldname, $newname)
    {
        return $this->filesystem->rename($oldname, $newname);
    }

    /**
     * Writes the passed data to file with the passed name.
     *
     * @param string $filename The name of the file to write the data to
     * @param string $data     The data to write to the file
     *
     * @return number The number of bytes written to the file
     */
    public function write($filename, $data)
    {
        return $this->filesystem->put($filename, $data);
    }

    /**
     * Delete the file with the passed name.
     *
     * @param string $filename The name of the file to be deleted
     *
     * @return boolean TRUE on success, else FALSE
     */
    public function delete($filename)
    {
        return $this->filesystem->delete($filename);
    }

    /**
     * Copy's a file from source to destination.
     *
     * @param string $src  The source file
     * @param string $dest The destination file
     *
     * @return boolean TRUE on success, else FALSE
     */
    public function copy($src, $dest)
    {
        return $this->filesystem->copy($src, $dest);
    }

    /**
     * List the filenames of a directory.
     *
     * @param string  $directory The directory to list
     * @param boolean $recursive Whether to list recursively
     *
     * @return array A list of filenames
     */
    public function listContents($directory = '', $recursive = false)
    {

        // initialize the array for the filenames
        $files = array();

        // load the filenames of the passed directory
        $contents = $this->filesystem->listContents($directory, $recursive);

        // prepare the array with the file names
        foreach ($contents as $key => $file) {
            $files[$key] = $file['path'];
        }

        // return the filenames
        return $files;
    }

    /**
     * Removes the passed directory recursively.
     *
     * @param string  $src       Name of the directory to remove
     * @param boolean $recursive TRUE if the directory has to be deleted recursive, else FALSE
     *
     * @return void
     * @throws \Exception Is thrown, if the directory can not be removed
     */
    public function removeDir($src, $recursive = false)
    {
        $this->filesystem->deleteDir($src);
    }

    /**
     * Find and return pathnames matching a pattern
     *
     * @param string $pattern No tilde expansion or parameter substitution is done.
     * @param int    $flags   Flags that changes the behaviour
     *
     * @return array Containing the matched files/directories, an empty array if no file matched or FALSE on error
     */
    public function glob(string $pattern, int $flags = 0)
    {
        throw new \Exception(sprintf('Method "%s" has not yet been implemented', __METHOD__));
    }

    /**
     * Return's the size of the file with the passed name.
     *
     * @param string $filename The name of the file to return the size for
     *
     * @return int The size of the file in bytes
     * @throws \Exception  Is thrown, if the size can not be calculated
     */
    public function size($filename)
    {
        return $this->filesystem->getSize($filename);
    }

    /**
     * Read's and return's the content of the file with the passed name as array.
     *
     * @param string $filename The name of the file to return its content for
     *
     * @return array The content of the file as array
     * @throws \Exception  Is thrown, if the file is not accessible
     */
    public function read($filename)
    {
        return $this->filesystem->read($filename);
    }
}
