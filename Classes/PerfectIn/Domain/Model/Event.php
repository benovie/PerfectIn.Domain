<?php

namespace PerfectIn\Domain\Model;

use TYPO3\Flow\Annotations as Flow;

/**
 * event model
 */
class Event {

	/**
	 * instance
	 * @var string
	 */
	protected $instance;
	
	/**
	 * time
	 * @var \DateTime
	 */
	protected $time;
	
	public function __construct(\PerfectIn\Domain\Event\EventInterface $instance) {
		$this->instance = serialze($instance);
		$this->time = new \DateTime();	
	}
	
	public function getTime() {
		return $this->time;
	}
	
	public function getInstance() {
		return unserialize($this->instance);
	}
}

?>
