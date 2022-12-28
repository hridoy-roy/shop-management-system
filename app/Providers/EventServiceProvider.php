<?php

namespace App\Providers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\PurchaseReturnDetail;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\SaleReturnDetail;
use App\Observers\PurchaseDetailObserver;
use App\Observers\PurchaseObserver;
use App\Observers\PurchaseReturnDetailObservr;
use App\Observers\SaleDetailObserver;
use App\Observers\SaleObserver;
use App\Observers\SaleReturnDetailObservr;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        PurchaseDetail::observe(PurchaseDetailObserver::class);
        Purchase::observe(PurchaseObserver::class);
        PurchaseReturnDetail::observe(PurchaseReturnDetailObservr::class);
        SaleDetail::observe(SaleDetailObserver::class);
        Sale::observe(SaleObserver::class);
        SaleReturnDetail::observe(SaleReturnDetailObservr::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
