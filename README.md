PerfectIn.Domain is TYPO3.Flow package for supporting domain events.

- Event publishing without any dependencies
- Event subscription without any depedencies


## Trigger domain event

```
 function doSomething($something) {
 	$event = new \PerfectIn\App\Domain\Event\SomethingHappenedEvent($something);
 }
```

 - add the annotation @PerfectIn\Domain\Annotations\Event to your domain event class
 - subscribe to event by @PerfectIn\Domain\Annotations\Subscribe("classnameOfDomainEvent")
 
## Domain event

- needs @PerfectIn\Domain\Annotations\Event
- annotation can be provided with
-- publish=true => to autmatically publish event after construction (default=true)
-- persist=true => to autmatically persist (TODO!) event after construction (default=false)

 
```

namespace PerfectIn\App\Domain\Event;

use PerfectIn\Domain\Annotations as Domain;

/**
 * something happened event
 * 
 * @Domain\Event
 */
class SomethingHappenedEvent  {

}

```


## Example Subscribe to domain event


```

use PerfectIn\Domain\Annotations as Domain;

/**
 * @Domain\Subscribe("PerfectIn\App\Domain\Event\SomethingHappenedEvent")
 * @param \PerfectIn\App\Domain\Event\SomethingHappenedEvent $somethingHappenedEvent
 */
public function logSomethingHappened(\PerfectIn\App\Domain\Event\SomethingHappenedEvent $somethingHappenedEvent) {

}

```