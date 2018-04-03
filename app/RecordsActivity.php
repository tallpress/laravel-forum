<?php

namespace App;

trait RecordsActivity
{

    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return;
        
        foreach (static::getRecordEvents() as $event) {
            static::$event(function($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected static function getRecordEvents()
    {
        return ['created'];
    }

    protected function recordActivity($eventType)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getShortClassName($eventType),
        ]);
    }

    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }

    protected function getShortClassName($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }
}
