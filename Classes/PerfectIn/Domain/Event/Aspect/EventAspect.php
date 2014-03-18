<?php
namespace PerfectIn\Domain\Event\Aspect;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Aop\JoinPointInterface;
use TYPO3\Flow\Reflection\ObjectAccess;
use Doctrine\ORM\Mapping as ORM;

/**
 * adds domainevent logic to annotated domain events
 *
 * @Flow\Scope("singleton")
 * @Flow\Aspect
 * @Flow\Introduce("PerfectIn\Domain\Event\Aspect\EventAspect->isEvent", interfaceName="PerfectIn\Domain\Event\EventInterface")
 */
class EventAspect {

	/**
	 * @Flow\Inject
	 * @var \PerfectIn\Domain\Event\EventManagerInterface
	 */
	protected $eventManager;
	
	/**
	 * @Flow\Inject
	 * @var PerfectIn\Domain\Event\EventRepository
	 */
	protected $eventRepository;
	
	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Reflection\ReflectionService
	 */
	protected $reflectionService;

	/**
	 * @var string
	 * 
	 * @ORM\Column(length=40)
	 * @Flow\Introduce("PerfectIn\Domain\Event\Aspect\EventAspect->isEvent")
	 */
	protected $created;
	
	/**
	 * @Flow\Pointcut("classAnnotatedWith(PerfectIn\Domain\Annotations\Event)")
	 */
	public function isEvent() {}

	/**
	 * After returning advice, making sure we have a created timestamp
	 *
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint The current join point
	 * @return void
	 * @Flow\Before("PerfectIn\Domain\Event\Aspect\EventAspect->isEvent && method(.*->__construct())")
	 */
	public function generateCreatedTime(JoinPointInterface $joinPoint) {
		$proxy = $joinPoint->getProxy();
		ObjectAccess::setProperty($proxy, 'created', time(), TRUE);
	}
	
	/**
	 * initialize event
	 *
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint The current join point
	 * @return void
	 * @Flow\After("PerfectIn\Domain\Event\Aspect\EventAspect->isEvent && method(.*->__construct())")
	 */
	public function initializeEvent(JoinPointInterface $joinPoint) {	
		$eventAnnotation = $this->reflectionService->getClassAnnotation($joinPoint->getClassName(), 'PerfectIn\Domain\Annotations\Event');

		if ($eventAnnotation->publish) {
			$this->eventManager->publish($joinPoint->getProxy());
		}
		if ($eventAnnotation->persist) {
			$this->eventRepository->add($joinPoint->getProxy());
		}
	}
}

?>
