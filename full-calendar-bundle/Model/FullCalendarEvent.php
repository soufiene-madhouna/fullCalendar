<?php

namespace AncaRebeca\FullCalendarBundle\Model;

use Symfony\Component\EventDispatcher\Event as Event;
use Symfony\Component\HttpFoundation\Request;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;

/**
 * Event used to store EventEntitys
 * 
 * @author Mike Yudin <mikeyudin@gmail.com>
 */
class FullCalendarEvent extends Event
{
    const CONFIGURE = 'calendar.load_events';

    private $startDatetime;
    
    private $endDatetime;
    
    private $request;

    private $events;
    
    /**
     * Constructor method requires a start and end time for event listeners to use.
     * 
     * @param \DateTime $start Begin datetime to use
     * @param \DateTime $end End datetime to use
     */
    public function __construct(\DateTime $start, \DateTime $end, Request $request = null)
    {
        $this->startDatetime = $start;
        $this->endDatetime = $end;
        $this->request = $request;
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getEvents()
    {
        return $this->events;
    }
    
    /**
     * If the event isn't already in the list, add it
     * 
     * @param EventEntity $event
     * @return CalendarEvent $this
     */
    public function addEvent(Event $event)
    {
        if (!$this->events($event)) {
            $this->events[] = $event;
        }
        
        return $this;
    }
    
    /**
     * Get start datetime 
     * 
     * @return \DateTime
     */
    public function getStartDatetime()
    {
        return $this->startDatetime;
    }

    /**
     * Get end datetime 
     * 
     * @return \DateTime
     */
    public function getEndDatetime()
    {
        return $this->endDatetime;
    }

    /**
     * Get request
     * 
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
