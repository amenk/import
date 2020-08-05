<?php

/**
 * TechDivision\Import\Subjects\I18n\DateConverterFactory
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
 * @copyright 2018 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Subjects\I18n;

use Symfony\Component\DependencyInjection\ContainerInterface;
use TechDivision\Import\Configuration\SubjectConfigurationInterface;

/**
 * Factory for date converter instances.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2018 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */
class DateConverterFactory implements DateConverterFactoryInterface
{

    /**
     * The DI container instance.
     *
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * Initialize the factory with the DI container instance.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container The DI container instance
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Creates and returns the date converter instance for the subject with the passed configuration.
     *
     * @param \TechDivision\Import\Configuration\SubjectConfigurationInterface $subject The subject to create the date converter for
     *
     * @return \TechDivision\Import\Subjects\I18n\DateConverterInterface The date converter instance
     */
    public function createDateConverter(SubjectConfigurationInterface $subject)
    {

        // create a new date converter instance for the subject with the passed configuration
        $dateConverter = $this->container->get($subject->getDateConverter()->getId());
        $dateConverter->setSubjectConfiguration($subject);

        // return the date converter instance
        return $dateConverter;
    }
}
