<?php

/**
 * TechDivision\Import\Loaders\Filters\FilterImplInterface
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
 * @copyright 2020 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Loaders\Filters;

/**
 * Interface for filter implementations.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2020 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */
interface FilterImplInterface
{

    /**
     * Add's the passed filter to the loader instance.
     *
     * @param \TechDivision\Import\Loaders\Filters\FilterInterface $filter The filter to add
     *
     * @return void
     */
    public function addFilter(FilterInterface $filter) : void;

    /**
     * Query's whether or not the loader has a filter with the passed name.
     *
     * @param string $name The name of the filter to query for
     *
     * @return bool TRUE if the filter is available, else FALSE
     */
    public function hasFilter(string $name) : bool;

    /**
     * Return's the filter with the passed name.
     *
     * @param string $name The name of the filter to be returned
     *
     * @return \TechDivision\Import\Loaders\Filters\FilterInterface The filter with the requested name
     * @throws \InvalidArgumentException Is thrown, if the requested filter is not available
     */
    public function getFilter(string $name) : FilterInterface;

    /**
     * Return's the array with the filter callbacks.
     *
     * @return \TechDivision\Import\Loaders\Filters\FilterInterface[] The filter callbacks
     */
    public function getFilters() : array;

    /**
     *
     * @param array $data
     *
     * @return void
     */
    public function filter(array &$data) : void;
}