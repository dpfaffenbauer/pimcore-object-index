<?php

namespace ObjectIndexBundle;

use ObjectIndexBundle\Installer\PimcoreInstaller;
use Pimcore\Extension\Bundle\AbstractPimcoreBundle;

class ObjectIndexBundle extends AbstractPimcoreBundle
{
    /**
     * {@inheritdoc}
     */
    public function getNiceName()
    {
        return 'Object Index';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'ObjectIndex lets you create Indexes and Filters of Objects';
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * {@inheritdoc}
     */
    public function getInstaller()
    {
        return new PimcoreInstaller();
    }

    /**
     * {@inheritdoc}
     */
    public function getAdminIframePath()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getJsPaths()
    {
        $jsFiles = [];

        if ($this->container->hasParameter('coreshop.application.pimcore.admin.js')) {
             $jsFiles = array_merge(
                $this->container->get('coreshop.resource_loader')->loadResources($this->container->getParameter('coreshop.application.pimcore.admin.js')),
                $this->container->get('coreshop.resource_loader')->loadResources($this->container->getParameter('object_index.pimcore.admin.js'))
            );
        }

        return $jsFiles;
    }

    /**
     * {@inheritdoc}
     */
    public function getCssPaths()
    {
        $cssFiles = [];

        if ($this->container->hasParameter('coreshop.application.pimcore.admin.css')) {
             $cssFiles = array_merge(
                $this->container->get('coreshop.resource_loader')->loadResources($this->container->getParameter('coreshop.application.pimcore.admin.css')),
                $this->container->get('coreshop.resource_loader')->loadResources($this->container->getParameter('object_index.pimcore.admin.css'))
            );
        }

        return $cssFiles;
    }

    /**
     * {@inheritdoc}
     */
    public function getEditmodeJsPaths()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getEditmodeCssPaths()
    {
        return [];
    }
}
