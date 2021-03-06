<?php

namespace LKDevelopment\UptimeMonitorCachetIntegration\Enums;

use Spatie\UptimeMonitor\Models\Monitor;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class Incident.
 */
class Incident implements Arrayable
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $message;
    /**
     * @var int
     */
    public $status;
    /**
     * @var bool
     */
    public $visible;
    /**
     * @var int
     */
    public $component_id;
    /**
     * @var int
     */
    public $component_status;
    /**
     * @var bool
     */
    public $notify;

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @param Monitor $monitor
     * @param string $eventClassName
     * @return static
     */
    public static function parse(Monitor $monitor, string $eventClassName)
    {
        $incident = new self();
        $incident->name = trans('laravel-uptime-monitor-cachet-integration::incident.'.$eventClassName.'.name', ['url' => $monitor->url]);
        $incident->message = trans('laravel-uptime-monitor-cachet-integration::incident.'.$eventClassName.'.message', ['url' => $monitor->url, 'date' => $monitor->uptime_status_last_change_date]);
        $incident->status = config('laravel-uptime-monitor-cachet-integration.defaults.status');
        $incident->visible = config('laravel-uptime-monitor-cachet-integration.defaults.visible');
        $incident->component_id = config('laravel-uptime-monitor-cachet-integration.defaults.component_id');
        $incident->component_status = config('laravel-uptime-monitor-cachet-integration.defaults.component_status');
        $incident->notify = config('laravel-uptime-monitor-cachet-integration.defaults.notify');

        return $incident;
    }
}
