<?php

namespace PerfectIn\Domain\Event;

use TYPO3\Flow\Annotations as Flow;

/**
 * The repository for events
 *
 * @Flow\Scope("singleton")
 */
class EventRepository {
	
	const ENTITY_CLASSNAME = NULL;
	
	public function add(EventInterface $event) {

	}
}

?>
