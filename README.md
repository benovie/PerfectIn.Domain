PerfectIn.Domain is TYPO3.Flow package for supporting domain events.

- Event publishing without any dependencies
- Event subscription without any depedencies


## Trigger domain event

```

use PerfectIn\App\Domain\Event as Event;

function doSomething($something) {
 	$event = new Event\SomethingHappenedEvent($something);
s}
```
 
## Domain event

- needs annotiation @PerfectIn\Domain\Annotations\Event
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


 - needs annotiation @PerfectIn\Domain\Annotations\Subscribe("classnameOfDomainEvent")

```

use PerfectIn\Domain\Annotations as Domain;
use PerfectIn\App\Domain\Event as Event;

/**
 * @Domain\Subscribe("PerfectIn\App\Domain\Event\SomethingHappenedEvent")
 * @param Event\SomethingHappenedEvent $somethingHappenedEvent
 */
public function logSomethingHappened(Event\SomethingHappenedEvent $somethingHappenedEvent) {

}

```