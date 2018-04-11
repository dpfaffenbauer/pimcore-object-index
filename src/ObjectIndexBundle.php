<?php

namespace ObjectIndexBundle;

use CoreShop\Bundle\IndexBundle\CoreShopIndexBundle;
use CoreShop\Bundle\ResourceBundle\AbstractResourceBundle;
use CoreShop\Bundle\ResourceBundle\ComposerPackageBundleInterface;
use CoreShop\Bundle\ResourceBundle\CoreShopResourceBundle;
use Pimcore\Extension\Bundle\PimcoreBundleInterface;
use Pimcore\HttpKernel\BundleCollection\BundleCollection;

class ObjectIndexBundle extends AbstractResourceBundle implements PimcoreBundleInterface, ComposerPackageBundleInterface
{
    /**
     * {@inheritdoc}
     */
    public static function registerDependentBundles(BundleCollection $collection)
    {
        parent::registerDependentBundles($collection);

        $collection->addBundle(new CoreShopIndexBundle(), 2400);
    }

    /**
     * {@inheritdoc}
     */
    public function getPackageName()
    {
        return 'dpfaffenbauer/pimcore-object-index';
    }

    /**
     * {@inheritdoc}
     */
    public function getSupportedDrivers()
    {
        return [
            CoreShopResourceBundle::DRIVER_PIMCORE,
        ];
    }

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
    public function getInstaller()
    {
        return $this->container->get(Installer::class);
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
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getCssPaths()
    {
        return [];
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
