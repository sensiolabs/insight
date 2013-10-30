<?php

/*
 * This file is part of the SensioLabsInsight package.
 *
 * (c) SensioLabs <contact@sensiolabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SensioLabs\Insight\Sdk\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

class Project
{
    /**
     * @see https://github.com/sensiolabs/connect/blob/master/src/SensioLabs/Connect/Api/Entity/Project.php
     */
    const TYPE_PHP_WEBSITE = 0;
    const TYPE_PHP_LIBRARY = 1;
    const TYPE_SYMFONY2_BUNDLE = 2;
    const TYPE_SYMFONY1_PLUGIN = 4;
    const TYPE_OTHER = 6;
    const TYPE_DRUPAL_MODULE = 7;
    const TYPE_LARAVAL_WEB_PROJECT = 8;
    const TYPE_SILEX_WEB_PROJECT = 9;
    const TYPE_SYMFONY2_WEB_PROJECT = 10;
    const TYPE_SYMFONY1_WEB_PROJECT = 11;

    /**
     * @Exclude()
     */
    public static $types = array(
        self::TYPE_SYMFONY2_WEB_PROJECT => 'Symfony2 Web Project',
        self::TYPE_SYMFONY1_WEB_PROJECT => 'symfony1 Web Project',
        self::TYPE_SILEX_WEB_PROJECT => 'Silex Web Project',
        self::TYPE_LARAVAL_WEB_PROJECT => 'Laravel Web Project',
        self::TYPE_SYMFONY2_BUNDLE => 'Symfony2 Bundle',
        self::TYPE_SYMFONY1_PLUGIN => 'symfony1 Plugin',
        self::TYPE_DRUPAL_MODULE => 'Drupal Module',
        self::TYPE_PHP_WEBSITE => 'PHP Web Project',
        self::TYPE_PHP_LIBRARY => 'PHP Library',
        self::TYPE_OTHER => 'Other',
    );

    /**
     * @Type("array<SensioLabs\Insight\Sdk\Model\Link>")
     * @XmlList(inline = true, entry = "link")
     */
    private $links;

    /**
     * @Type("string")
     * @SerializedName("id")
     */
    private $uuid;

    /** @Type("string") */
    private $name;

    /** @Type("string") */
    private $configuration;

    /** @Type("string") */
    private $description;

    /** @Type("string") */
    private $type;

    /**
     * @Type("string")
     * @SerializedName("repository-url")
     */
    private $repositoryUrl;

    /** @Type("boolean") */
    private $private;

    /**
     * @Type("boolean")
     * @SerializedName("report-available")
     */
    private $reportAvailable;

    /**
     * @Type("SensioLabs\Insight\Sdk\Model\Analysis")
     * @SerializedName("last-analysis")
     */
    private $lastAnalysis;

    public function toArray()
    {
        return array(
            'name'          => $this->name,
            'public'        => !$this->private,
            'description'   => $this->description,
            'repositoryUrl' => $this->repositoryUrl,
            'type'          => $this->type,
            'configuration' => $this->configuration,
        );
    }

    public function getLinks()
    {
        return $this->links;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        if (!array_key_exists($type, static::$types)) {
            throw new \InvalidArgumentException(sprintf('"%s" is not a valid type. You must pick one among "%"', $type, implode('", "', array_keys(static::$types))));
        }

        $this->type = $type;

        return $this;
    }

    public function getRepositoryUrl()
    {
        return $this->repositoryUrl;
    }

    public function setRepositoryUrl($repositoryUrl)
    {
        $this->repositoryUrl = $repositoryUrl;

        return $this;
    }

    public function isPublic()
    {
        return !$this->private;
    }

    public function setPublic($isPublic = false)
    {
        $this->private = !$isPublic;

        return $this;
    }

    public function isPrivate()
    {
        return $this->private;
    }

    public function setPrivate($isPrivate = true)
    {
        $this->private = $isPrivate;

        return $this;
    }

    public function isReportAvailable()
    {
        return $this->reportAvailable;
    }

    public function getLastAnalysis()
    {
        return $this->lastAnalysis;
    }
}
