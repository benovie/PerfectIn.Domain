<?php

namespace PerfectIn\Domain\Event;

use TYPO3\Flow\Annotations as Flow;

/**
 * event manager
 * 
 * @Flow\Scope("singleton")
 */
class EventManager implements EventManagerInterface {
	
	/**
	 * subscriptions
	 * 
	 * @var array
	 */
	protected $subscriptions = array();

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Reflection\ReflectionService
	 */
	protected $reflectionService;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Object\ObjectManagerInterface
	 */
	protected $objectManager;
	
	/**
	 * automatically add all subscribe methods to eventmanager
	 * 
	 * @return void
	 */
	public function initializeObject() {
		$subscribeClasses = $this->reflectionService->getClassesContainingMethodsAnnotatedWith('PerfectIn\Domain\Annotations\Subscribe');	
		foreach($subscribeClasses AS $subscribeClass) {
			foreach(get_class_methods($subscribeClass) AS $method) {
				$annotation = $this->reflectionService->getMethodAnnotation($subscribeClass, $method, 'PerfectIn\Domain\Annotations\Subscribe');
				if ($annotation) {
					$this->subscribe($annotation->event, array($subscribeClass, $method));
				}
			}
		}
	}
	
	/**
	 * publish event
	 * 
	 * @param EventInterface $event
	 * @return void
	 */
	public function publish(EventInterface $event) {
		$eventName = get_class($event);
		if (isset($this->subscriptions[$eventName])) {
			foreach ($this->subscriptions[$eventName] AS $callback) {
				if (is_array($callback)) {
					$callback[0] = $this->objectManager->get($callback[0]);
				}
				call_user_func_array($callback, array($event));
			}
		}
	}
	
	
	/**
	 * subscribe to event
	 *
	 * @param string $eventName name of class
	 * @param string|array $callback
	 * @return void
	 */
	public function subscribe($eventName, $callback) {
		if (!isset($this->subscriptions[$eventName])) {
			$this->subscriptions[$eventName] = array();
		}
		$this->subscriptions[$eventName][] = $callback;
	}
	
}