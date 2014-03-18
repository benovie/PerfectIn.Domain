<?php
namespace PerfectIn\Domain\Annotations;

/**
 * subscribe to event
 *
 * @Annotation
 * @Target("METHOD")
 */
final class Subscribe {
	
	/**
	 * event to subscribe to
	 * @var string
	 */
	public $event;
	
	/**
	 * @param array $values
	 */
	public function __construct(array $values) {
		if (!isset($values['value'])) {
			throw new \InvalidArgumentException('An Subscribe annotation must specify an event name.', 1218456620);
		}
		
		$this->event = $values['value'];
	}
}

?>