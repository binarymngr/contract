<?php

namespace BinaryMngr\Contract\Gatherers;

/**
 * The BinaryVersionsGatherer interface is used to check if new versions of
 * binaries exist. A typical example would be some kind of 'GithubTagsGatherer'
 * that looks-up versions based on the tags page on Github.
 *
 * Within the main application, those gatherers are associated with binaries
 * and the scheduler will run them e.g. each day to get new binary versions
 * and create DB records for them. Given that, other parts of the main application
 * will create user messages for outdated binary versions etc.
 *
 * Note: All exceptions thrown in here need to be of kind
 * \BinaryMngr\Contract\BinaryVersionsGathererException;
 */
interface BinaryVersionsGatherer
{
    /**
     * Constants for the keys the returned associative arrays should include.
     *
     * @var string
     */
    const KEY_IDENTIFIER = 'identifier';
    const KEY_NOTE       = 'note';
    const KEY_EOL        = 'eol';


    /**
     * Performs the actual gathering by fetching the binary versions from
     * the external source.
     */
    public function gather();

    /**
     * Returns the latest version of all gathered binary versions.
     *
     * If no such version exists, null should be returned.
     *
     * @return array an associative array containing the const fields defined in this interface
     */
    public function getLatestVersion();

    /**
     * Returns the gatherer's name (e.g. GitHubsTagsGatherer)
     *
     * @return string
     */
    public function getName();

    /**
     * Returns all binary versions the last gather() call recognized.
     *
     * @return array all gathered binary versions
     */
    public function getVersions();

    /**
     * Sets the binary for which versions should be gathered.
     *
     * @param array $binary an array describing the binary ($binary->toArray())
     *
     * @return \BinaryMngr\Contract\Gatherers\BinaryVersionsGatherer $this
     */
    public function setBinary(array $binary);
}
