<?php
/**
 * @author PC Drew <pc@schoolblocks.com>
 */
use Tester\Assert;

require_once __DIR__ . '/../vendor/autoload.php';
\Tester\Environment::setup();

$cal = new \om\IcalParser();


$results = $cal->parseFile(__DIR__ . '/cal/recur_instances_finite.ics');
$events = $cal->getSortedEvents();

Assert::false(empty($events[0]['RECURRENCES']));

// DTSTART;TZID=America/Los_Angeles:20121002T100000
// DTEND;TZID=America/Los_Angeles:20121002T103000
// RRULE:FREQ=MONTHLY;INTERVAL=1;BYDAY=1TU;UNTIL=20121231T100000
// RDATE;TZID=America/Los_Angeles:20121110T100000
// RDATE;TZID=America/Los_Angeles:20121105T100000
$recurrences = $events[0]['RECURRENCES'];
Assert::equal(5, sizeof($recurrences));
Assert::equal($events[0]['DTSTART'], $recurrences[0]);
Assert::equal('5.11.2012 10:00:00', $recurrences[1]->format('j.n.Y H:i:s'));
Assert::equal('6.11.2012 10:00:00', $recurrences[2]->format('j.n.Y H:i:s'));
Assert::equal('10.11.2012 10:00:00', $recurrences[3]->format('j.n.Y H:i:s'));
Assert::equal('4.12.2012 10:00:00', $recurrences[4]->format('j.n.Y H:i:s'));

$eventsWithRecurring = $cal->getSortedEvents(true);
Assert::equal(5, sizeof($eventsWithRecurring));
Assert::equal($eventsWithRecurring[0]['DTSTART'], $recurrences[0]);
Assert::equal($eventsWithRecurring[1]['DTSTART'], $recurrences[1]);
Assert::equal($eventsWithRecurring[2]['DTSTART'], $recurrences[2]);
Assert::equal($eventsWithRecurring[3]['DTSTART'], $recurrences[3]);
Assert::equal($eventsWithRecurring[4]['DTSTART'], $recurrences[4]);

$results = $cal->parseFile(__DIR__ . '/cal/recur_instances.ics');
$events = $cal->getSortedEvents();

Assert::false(empty($events[0]['RECURRENCES']));

// DTSTART;TZID=America/Los_Angeles:20121002T100000
// DTEND;TZID=America/Los_Angeles:20121002T103000
// RRULE:FREQ=MONTHLY;INTERVAL=1;BYDAY=1TU
// RDATE;TZID=America/Los_Angeles:20121105T100000
// RDATE;TZID=America/Los_Angeles:20121110T100000,20121130T100000
// EXDATE;TZID=America/Los_Angeles:20130402T100000
// EXDATE;TZID=America/Los_Angeles:20121204T100000
// EXDATE;TZID=America/Los_Angeles:20130205T100000
// total = 36 events - 3 exclusions + 3 additions
//      because there is no "UNTIL", we only calculate the next 3 years of repeating events
$recurrences = $events[0]['RECURRENCES'];
Assert::equal(34, sizeof($recurrences));
Assert::equal('06.11.2012 10:00:00', $recurrences[0]->format('d.m.Y H:i:s'));
Assert::equal('10.11.2012 10:00:00', $recurrences[1]->format('d.m.Y H:i:s'));
Assert::equal('30.11.2012 10:00:00', $recurrences[2]->format('d.m.Y H:i:s'));
Assert::equal('01.01.2013 10:00:00', $recurrences[3]->format('d.m.Y H:i:s'));
Assert::equal('05.03.2013 10:00:00', $recurrences[4]->format('d.m.Y H:i:s'));
Assert::equal('07.05.2013 10:00:00', $recurrences[5]->format('d.m.Y H:i:s'));
Assert::equal('04.06.2013 10:00:00', $recurrences[6]->format('d.m.Y H:i:s'));
Assert::equal('02.07.2013 10:00:00', $recurrences[7]->format('d.m.Y H:i:s'));
Assert::equal('06.08.2013 10:00:00', $recurrences[8]->format('d.m.Y H:i:s'));
Assert::equal('03.09.2013 10:00:00', $recurrences[9]->format('d.m.Y H:i:s'));
Assert::equal('01.10.2013 10:00:00', $recurrences[10]->format('d.m.Y H:i:s'));
Assert::equal('05.11.2013 10:00:00', $recurrences[11]->format('d.m.Y H:i:s'));
Assert::equal('03.12.2013 10:00:00', $recurrences[12]->format('d.m.Y H:i:s'));
Assert::equal('07.01.2014 10:00:00', $recurrences[13]->format('d.m.Y H:i:s'));
Assert::equal('04.02.2014 10:00:00', $recurrences[14]->format('d.m.Y H:i:s'));
Assert::equal('04.03.2014 10:00:00', $recurrences[15]->format('d.m.Y H:i:s'));
Assert::equal('01.04.2014 10:00:00', $recurrences[16]->format('d.m.Y H:i:s'));
Assert::equal('06.05.2014 10:00:00', $recurrences[17]->format('d.m.Y H:i:s'));
Assert::equal('03.06.2014 10:00:00', $recurrences[18]->format('d.m.Y H:i:s'));
Assert::equal('01.07.2014 10:00:00', $recurrences[19]->format('d.m.Y H:i:s'));
Assert::equal('05.08.2014 10:00:00', $recurrences[20]->format('d.m.Y H:i:s'));
Assert::equal('02.09.2014 10:00:00', $recurrences[21]->format('d.m.Y H:i:s'));
Assert::equal('07.10.2014 10:00:00', $recurrences[22]->format('d.m.Y H:i:s'));
Assert::equal('04.11.2014 10:00:00', $recurrences[23]->format('d.m.Y H:i:s'));
Assert::equal('02.12.2014 10:00:00', $recurrences[24]->format('d.m.Y H:i:s'));
Assert::equal('06.01.2015 10:00:00', $recurrences[25]->format('d.m.Y H:i:s'));
Assert::equal('03.02.2015 10:00:00', $recurrences[26]->format('d.m.Y H:i:s'));
Assert::equal('03.03.2015 10:00:00', $recurrences[27]->format('d.m.Y H:i:s'));
Assert::equal('07.04.2015 10:00:00', $recurrences[28]->format('d.m.Y H:i:s'));
Assert::equal('05.05.2015 10:00:00', $recurrences[29]->format('d.m.Y H:i:s'));
Assert::equal('02.06.2015 10:00:00', $recurrences[30]->format('d.m.Y H:i:s'));
Assert::equal('07.07.2015 10:00:00', $recurrences[31]->format('d.m.Y H:i:s'));
Assert::equal('04.08.2015 10:00:00', $recurrences[32]->format('d.m.Y H:i:s'));
Assert::equal('01.09.2015 10:00:00', $recurrences[33]->format('d.m.Y H:i:s'));

foreach($events[0]['EXDATES'] as $exDate) {
    Assert::notContains($exDate, $recurrences);
}


$results = $cal->parseFile(__DIR__ . '/cal/recur_instances_with_modifications.ics');
$events = $cal->getSortedEvents(true);

Assert::false(empty($events[0]['RECURRENCES']));
// the 12th entry is the modified event, related to the remaining recurring events
Assert::true(empty($events[12]['RECURRENCES']));

$recurrences = $events[0]['RECURRENCES'];
$modifiedEvent = $events[12];

// There should be 35 total recurrences because the modified event should've removed 1 recurrence
Assert::equal(35, sizeof($recurrences));
// There should be 36 total events because of the modified event + 35 recurrences
Assert::equal(36, sizeof($events));
Assert::notContains($modifiedEvent['DTSTART'], $recurrences);

$results = $cal->parseFile(__DIR__ . '/cal/recur_instances_with_modifications_and_interval.ics');

// Build the cache of RECURRENCE-IDs and EXDATES first, so that we can properly determine the interval
$eventCache = array();
foreach($results['VEVENT'] as $event) {
    $eventSequence = empty($event['SEQUENCE']) ? "0" : $event['SEQUENCE'];
    $eventRecurrenceID = empty($event['RECURRENCE-ID']) ? "0" : $event['RECURRENCE-ID'];

    $eventCache[$event['UID']][$eventRecurrenceID][$eventSequence] = $event;
}
$trueEvents = array();
foreach($results['VEVENT'] as $event) {
    if(empty($event['RECURRENCES'])) {
        $trueEvents[] = $event;
    } else {
        $eventUID = $event['UID'];
        foreach($event['RECURRENCES'] as $recurrence) {
            $eventRecurrenceID = $recurrence->format("Ymd");
            if(empty($eventCache[$eventUID][$eventRecurrenceID])) {
                $trueEvents[$eventRecurrenceID] = array('DTSTART' => $recurrence);
            } else {
                krsort($eventCache[$eventUID][$eventRecurrenceID]);
                $keys = array_keys($eventCache[$eventUID][$eventRecurrenceID]);
                $trueEvents[$eventRecurrenceID] = $eventCache[$eventUID][$eventRecurrenceID][$keys[0]];
            }
        }
    }
}

usort($trueEvents, function ($a, $b) {
    return $a['DTSTART'] > $b['DTSTART'];
});

$events = $cal->getSortedEvents(true);
Assert::false(empty($events[0]['RECURRENCES']));
Assert::equal(count($trueEvents), count($events));
foreach($trueEvents as $index => $trueEvent) {
    Assert::equal($trueEvent['DTSTART']->format("Ymd"), $events[$index]['DTSTART']->format("Ymd"));
}

/*
$results = $cal->parseFile(__DIR__ . '/cal/recur_instances_with_modifications_to_first_day.ics');
$events = $cal->getSortedEvents();
Assert::false(empty($events[0]['RECURRENCES']));
Assert::equal(1, count($events));
*/
