<?php

namespace PerfectIn\Domain\Event;

/**
 * 
 * Event manager interface
 * 
 * @author benjaminheek
 */
interface EventManagerInterface{
	
	/**
	 * publish event
	 * 
	 * @param EventInterface $event
	 * @return void
	 */
	public function publish(EventInterface $event);
	
	/**
	 * subscribe to event
	 * 
	 * @param string $eventName
	 * @param string|array|function $callback
	 * @return void
	 */
	public function subscribe($eventName, $callback);

}