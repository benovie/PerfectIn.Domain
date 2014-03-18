<?php
namespace PerfectIn\Domain\Annotations;

/**
 * Marks an object as an domain event
 *
 * @Annotation
 * @Target("CLASS")
 */
final class Event {
	
	/**
	 * publish event
	 * @var boolean
	 */
	public $publish = true;
	
	/**
	 * persist event
	 * @var boolean
	 */
	public $persist= false;
	
	/**
	 * @param array $values
	 */
	public function __construct(array $values) {
		if (isset($values['publish'])) {
			$this->publish = $values['publish'];
		}
		if (isset($values['persist'])) {
			$this->persist = $values['persist'];
		}
	}

}

?>