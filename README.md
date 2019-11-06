# Imoisey/Cross

Библиотека для поиска временных пересечений.

## Installation

Установка через менеджер пакетов composer.

```bash
composer require imoisey/cross
```

## Usage

Создать класс провайдера данных, который будет реализовывать интерфейс ProviderInterface.

```php
use Imoisey\Cross\Provider\ProviderInterface;

class PeopleProvider implements ProviderInterface
{

    public function getCollections()
    {

    }


    public function getName()
    {

    }
}
```

Создать класс коллекции, который будет расширять абстрактный класс Collection.

```php
use Imoisey\Cross\Collection\Collection;

class PeopleCollection extends Collection
{

}
```

Создать класс элемента, который будет являться частью коллекции и реализовать интерфейс ItemInteface.

```php
use Imoisey\Cross\ItemInterface;

class EventItem extends ItemInterface
{
    public function getPeriod()
    {

    }
}
```

Выполнить настройку менеджера пересечений.

```php
use Imoisey\Cross\Manager;

$provider = new PeopleProvider();
$manager = new Manager($provider);

if ($manager->verify()) {
    $manager->getCollision();
}
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)