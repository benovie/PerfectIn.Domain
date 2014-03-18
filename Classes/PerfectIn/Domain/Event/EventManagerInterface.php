<?php

namespace PerfectIn\Domain\Event;

/**
 * 
 * Event manager interface
 * 
 * @author benjaminheek
 */
interface EventManagerInterface{
	
	public function publish(EventInterface $event);
	
	public function subscribe($eventName, $callback);

}