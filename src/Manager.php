<?php

namespace Imoisey\Cross;

use Imoisey\Cross\Provider\ProviderInterface;

class Manager
{
    protected $collision = [];

    protected $providers = [];

    public function __construct(ProviderInterface $provider)
    {
        $this->addProvider($provider);
    }

    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[$provider->getName()] = $provider;
    }

    public function verify()
    {
        $this->collision = [];
        foreach($this->providers as $providerName => $provider) {
            $collections = $provider->getCollections();
            foreach($collections as $collection) {
                if($collection->verify()) {
                    $this->collision[$providerName][] = $collection;
                }
            }
        }

        return !empty($this->collision);
    }

    public function getCollision($providerName = null)
    {
        if(isset($this->collision[$providerName])) {
            return $this->collision[$providerName];
        }

        return $this->collision;
    }
}