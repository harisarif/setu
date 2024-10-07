<?php

namespace App\Providers;

use App\GeneralSetting;
use App\Language;
use App\Page;
use App\Extension;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $activeTemplate = activeTemplate();

        $viewShare['general'] = GeneralSetting::first();
        $viewShare['activeTemplate'] = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
        $viewShare['language'] = Language::all();
        $viewShare['pages'] = Page::where('tempname',$activeTemplate)->where('slug','!=','home')->get();
        view()->share($viewShare);


        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'banned_users_count'           => \App\User::banned()->count(),
                'email_unverified_users_count' => \App\User::emailUnverified()->count(),
                'sms_unverified_users_count'   => \App\User::smsUnverified()->count(),
                'pending_ticket_count'         => \App\SupportTicket::whereIN('status', [0,2])->count(),
                'pending_deposits_count'    => \App\Deposit::pending()->count(),
                'pending_withdraw_count'    => \App\Withdrawal::pending()->count(),
                'inactive_category'             => \App\Category::where('mode', 0)->count(),
                'fund_request'                  => \App\Campaign::where('approval', 0)->where('rejected', 0)->count(),
                'update_fund_request'           => \App\ExtendCampaign::where('approval', 0)->where('rejected', 0)->count(),
                'blog_review'                   => \App\BlogComment::where('status',0)->count(),
                'campaign_review'                   => \App\Comment::where('published',0)->count(),
                'pending_volunteer'                   => \App\Volunteer::where('status',0)->count()
            ]);
        });

        view()->composer('partials.seo', function ($view) {
            $seo = \App\Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });

    }
}
