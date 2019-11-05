<?php

namespace Imoisey\Cross;

use Imoisey\Cross\Provider\ProviderInterface;

/**
 * Управляет механизмамом поиска пересечений
 * 
 * ```php
 * $manager = new Manager(ProviderInterface $provider);
 * if ($manager->verify()) {
 *      $manager->getCollision();
 * }
 * ```
 * 
 */
class Manager
{
    /** @var array */
    protected $collision = [];

    /** @var array */
    protected $providers = [];

    /**
     * Инициализация объекта.
     * В качестве аргумента передается провайдер данных.
     *
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->addProvider($provider);
    }

    /**
     * Добавление дополнительных провайдеров данных
     *
     * @param ProviderInterface $provider
     * @return void
     */
    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[$provider->getName()] = $provider;
    }

    /**
     * Выполняет проверку пересечений по всем коллекциям добавленных провайдеров
     *
     * @return bool
     */
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

    /**
     * Возвращает коллекции, которые содержат пересечения.
     * Поддерживает фильтрацию по провайдеру.
     *
     * @param string $providerName
     * @return CollectionInterface[]
     */
    public function getCollision($providerName = null)
    {
        if(isset($this->collision[$providerName])) {
            return $this->collision[$providerName];
        }

        return $this->collision;
    }
}
