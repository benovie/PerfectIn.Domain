Package to support domain events

 - add the annotation @PerfectIn\Domain\Annotations\Event to your domain event class
 - subscribe to event by @PerfectIn\Domain\Annotations\Subscribe("classnameOfDomainEvent")
 
 Example Domain event:
 
```

namespace PerfectIn\App\Domain\Event;

use PerfectIn\Domain\Annotations as Domain;
use TYPO3\Flow\Annotations as Flow;

/**
 * event
 * 
 * @Domain\Event
 */
class SomethingHappenedEvent  {
		
	/**
	 * something
	 * 
	 * @var string
	 */
	protected $something;
	
	
	public function __construct($something) {
		$this->something = $something;
	}
	
	public function getSomething() {
		return $this->something;
	}
}

```


Example Subscribe to domain event


```


/**
 * @Domain\Subscribe("PerfectIn\App\Domain\Event\SomethingHappenedEvent")
 * @param \PerfectIn\App\Domain\Event\SomethingHappenedEvent $playerReadEvent
 */
public function logRead(\PerfectIn\App\Domain\Event\SomethingHappenedEvent $playerReadEvent) {
	$playerReadEvent->getSomething();
}

```