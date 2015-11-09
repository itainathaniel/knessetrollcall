<?php

namespace KnessetRollCall\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        'KnessetRollCall\Events\SomeEvent' => [
//            'KnessetRollCall\Listeners\EventListener',
//        ],
        'KnessetRollCall\Events\errorFetchingLogEntries' => [
            'KnessetRollCall\Listeners\mailError',
        ],
        'KnessetRollCall\Events\newKnessetMember' => [
            'KnessetRollCall\Listeners\mailAdmin',
        ],
//        'knessetMemberIn' => [],
//        'knessetMemberOut' => [],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
