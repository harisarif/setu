<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function(){
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::namespace('Gateway')->prefix('ipn')->name('ipn.')->group(function () {
    Route::post('paypal', 'paypal\ProcessController@ipn')->name('paypal');
    Route::get('paypal_sdk', 'paypal_sdk\ProcessController@ipn')->name('paypal_sdk');
    Route::post('perfect_money', 'perfect_money\ProcessController@ipn')->name('perfect_money');
    Route::post('stripe', 'stripe\ProcessController@ipn')->name('stripe');
    Route::post('stripe_js', 'stripe_js\ProcessController@ipn')->name('stripe_js');
    Route::post('stripe_v3', 'stripe_v3\ProcessController@ipn')->name('stripe_v3');
    Route::post('skrill', 'skrill\ProcessController@ipn')->name('skrill');
    Route::post('paytm', 'paytm\ProcessController@ipn')->name('paytm');
    Route::post('payeer', 'payeer\ProcessController@ipn')->name('payeer');
    Route::post('paystack', 'paystack\ProcessController@ipn')->name('paystack');
    Route::post('voguepay', 'voguepay\ProcessController@ipn')->name('voguepay');
    Route::get('flutterwave/{trx}/{type}', 'flutterwave\ProcessController@ipn')->name('flutterwave');
    Route::post('razorpay', 'razorpay\ProcessController@ipn')->name('razorpay');
    Route::post('instamojo', 'instamojo\ProcessController@ipn')->name('instamojo');
    Route::get('blockchain', 'blockchain\ProcessController@ipn')->name('blockchain');
    Route::get('blockio', 'blockio\ProcessController@ipn')->name('blockio');
    Route::post('coinpayments', 'coinpayments\ProcessController@ipn')->name('coinpayments');
    Route::post('coinpayments_fiat', 'coinpayments_fiat\ProcessController@ipn')->name('coinpayments_fiat');
    Route::post('coingate', 'coingate\ProcessController@ipn')->name('coingate');
    Route::post('coinbase_commerce', 'coinbase_commerce\ProcessController@ipn')->name('coinbase_commerce');
    Route::get('mollie', 'mollie\ProcessController@ipn')->name('mollie');
    Route::post('cashmaal', 'cashmaal\ProcessController@ipn')->name('cashmaal');
    Route::post('mercado-pago', 'MercadoPago\ProcessController@ipn')->name('MercadoPago');
});

// User Support Ticket
Route::prefix('ticket')->group(function () {
    Route::get('/', 'TicketController@supportTicket')->name('ticket');
    Route::get('/new', 'TicketController@openSupportTicket')->name('ticket.open');
    Route::post('/create', 'TicketController@storeSupportTicket')->name('ticket.store');
    Route::get('/view/{ticket}', 'TicketController@viewTicket')->name('ticket.view');
    Route::put('/reply/{ticket}', 'TicketController@replyTicket')->name('ticket.reply');
    Route::get('/download/{ticket}', 'TicketController@ticketDownload')->name('ticket.download');
});


/*
|--------------------------------------------------------------------------
| Start Admin Area
|--------------------------------------------------------------------------
*/

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login')->name('login');
        Route::get('logout', 'LoginController@logout')->name('logout');

        // Admin Password Reset
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify-code');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.change-link');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
    });


    Route::middleware('admin')->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('profile', 'AdminController@profile')->name('profile');
        Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
        Route::get('password', 'AdminController@password')->name('password');
        Route::post('password', 'AdminController@passwordUpdate')->name('password.update');

        Route::get('volunteer','AdminController@volunteer')->name('volunteer');
        Route::get('volunteer/details/{id}','AdminController@volunteerEdit')->name('volunteer.edit');
        Route::post('volunteer/details/{id}','AdminController@volunteerUpdate')->name('volunteer.edit');
        Route::get('volunteer/email/single/{id}', 'AdminController@showEmailSingleForm')->name('volunteer.mail');
        Route::post('volunteer/email/single/{id}', 'AdminController@sendEmailSingle');
        Route::get('volunteer/search', 'AdminController@searchVolunteer')->name('volunteer.search');

        // Users Manager
        Route::get('users', 'ManageUsersController@allUsers')->name('users.all');
        Route::get('users/active', 'ManageUsersController@activeUsers')->name('users.active');
        Route::get('users/banned', 'ManageUsersController@bannedUsers')->name('users.banned');
        Route::get('users/email-verified', 'ManageUsersController@emailVerifiedUsers')->name('users.emailVerified');
        Route::get('users/email-unverified', 'ManageUsersController@emailUnverifiedUsers')->name('users.emailUnverified');
        Route::get('users/sms-unverified', 'ManageUsersController@smsUnverifiedUsers')->name('users.smsUnverified');
        Route::get('users/sms-verified', 'ManageUsersController@smsVerifiedUsers')->name('users.smsVerified');

        Route::get('users/{scope}/search', 'ManageUsersController@search')->name('users.search');
        Route::get('user/detail/{id}', 'ManageUsersController@detail')->name('users.detail');
        Route::post('user/update/{id}', 'ManageUsersController@update')->name('users.update');
        Route::post('user/add-sub-balance/{id}', 'ManageUsersController@addSubBalance')->name('users.addSubBalance');
        Route::get('user/send-email/{id}', 'ManageUsersController@showEmailSingleForm')->name('users.email.single');
        Route::post('user/send-email/{id}', 'ManageUsersController@sendEmailSingle')->name('users.email.single');
        Route::get('user/transactions/{id}', 'ManageUsersController@transactions')->name('users.transactions');
        Route::get('user/deposits/{id}', 'ManageUsersController@deposits')->name('users.deposits');
        Route::get('user/deposits/via/{method}/{type?}/{userId}', 'ManageUsersController@depViaMethod')->name('users.deposits.method');
        Route::get('user/withdrawals/{id}', 'ManageUsersController@withdrawals')->name('users.withdrawals');
        Route::get('user/withdrawals/via/{method}/{type?}/{userId}', 'ManageUsersController@withdrawalsViaMethod')->name('users.withdrawals.method');
        Route::get('user/campaigns/{id}', 'ManageUsersController@campaigns')->name('users.campaigns');

        // Login History
        Route::get('users/login/history/{id}', 'ManageUsersController@userLoginHistory')->name('users.login.history.single');

        Route::get('users/send-email', 'ManageUsersController@showEmailAllForm')->name('users.email.all');
        Route::post('users/send-email', 'ManageUsersController@sendEmailAll')->name('users.email.send');

        // category

        Route::get('category','CategoryController@index')->name('category');
        Route::post('category','CategoryController@store');

        Route::put('category/{slug}','CategoryController@updateCategory')->name('category.update');

        // Fundrise

        Route::get('fundrise','FundriseController@showAllFundReq')->name('fundrise');
        Route::get('fundrise/delete/{slug}/{id}','FundriseController@delete')->name('fundrise.delete');
        Route::get('fundrise/edit/{slug}/{id}','FundriseController@edit')->name('fundrise.edit');
        Route::post('fundrise/edit/{slug}/{id}','FundriseController@approve');
        Route::put('fundrise/edit/{slug}/{id}','FundriseController@reject');
        Route::post('fundrise/featured','FundriseController@featured')->name('make.featured');

        Route::get('fudrise/success','FundriseController@success')->name('fundrise.success');
        Route::get('fundrise/approved','FundriseController@approved')->name('fundrise.approved');
        Route::get('fundrise/pending','FundriseController@pending')->name('fundrise.pending');
        Route::get('fundrise/rejected','FundriseController@rejected')->name('fundrise.rejected');
        Route::get('fundrise/running','FundriseController@running')->name('fundrise.running');
        Route::get('fundrise/request','FundriseController@fundRequest')->name('fundrise.request');
        Route::get('fundrise/request/edit/{slug}/{id}','FundriseController@fundRequestEdit')->name('fundrise.request.edit');
        Route::post('fundrise/request/edit/{slug}/{id}','FundriseController@fundRequestEditApproved');
        Route::put('fundrise/request/edit/{slug}/{id}','FundriseController@fundRequestEditrejected');
        Route::get('fundrise/request/delete/{slug}/{id}','FundriseController@fundRequestDelete')->name('fundrise.request.delete');
        Route::get('fundrise/review','FundriseController@fundReview')->name('fundrise.review');
        Route::post('fundrise/review','FundriseController@fundReviewPublished');


        // success Story

        Route::get('success/story','BlogController@showAll')->name('success.all');
        Route::get('success/story/create','BlogController@index')->name('success.story');
        Route::post('success/story/create','BlogController@store');

        Route::get('success/details/{slug}/{id}','BlogController@details')->name('success.details');

        Route::get('success/story/edit/{slug}/{id}','BlogController@edit')->name('success.edit');
        Route::post('success/story/edit/{slug}/{id}','BlogController@update');
        Route::get('success/story/delete/{slug}','BlogController@delete')->name('success.delete');
        Route::get('success/review','BlogController@review')->name('success.review');
        Route::post('success/review','BlogController@reviewUpdate');


        // Donation

        Route::get('donation/all','FundriseController@allDonor')->name('donor');

        // Subscriber
        Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
        Route::get('subscriber/send-email', 'SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
        Route::post('subscriber/remove', 'SubscriberController@remove')->name('subscriber.remove');
        Route::post('subscriber/send-email', 'SubscriberController@sendEmail')->name('subscriber.sendEmail');

            // Deposit Gateway
        Route::name('gateway.')->prefix('gateway')->group(function(){
            // Automatic Gateway
            Route::get('automatic', 'GatewayController@index')->name('automatic.index');
            Route::get('automatic/edit/{alias}', 'GatewayController@edit')->name('automatic.edit');
            Route::post('automatic/update/{code}', 'GatewayController@update')->name('automatic.update');
            Route::post('automatic/remove/{code}', 'GatewayController@remove')->name('automatic.remove');
            Route::post('automatic/activate', 'GatewayController@activate')->name('automatic.activate');
            Route::post('automatic/deactivate', 'GatewayController@deactivate')->name('automatic.deactivate');

            // Manual Methods
            Route::get('manual', 'ManualGatewayController@index')->name('manual.index');
            Route::get('manual/new', 'ManualGatewayController@create')->name('manual.create');
            Route::post('manual/new', 'ManualGatewayController@store')->name('manual.store');
            Route::get('manual/edit/{alias}', 'ManualGatewayController@edit')->name('manual.edit');
            Route::post('manual/update/{id}', 'ManualGatewayController@update')->name('manual.update');
            Route::post('manual/activate', 'ManualGatewayController@activate')->name('manual.activate');
            Route::post('manual/deactivate', 'ManualGatewayController@deactivate')->name('manual.deactivate');
        });

        Route::name('deposit.')->prefix('deposit')->group(function () {
                Route::get('/', 'DepositController@deposit')->name('list');
                Route::get('pending', 'DepositController@pending')->name('pending');
                Route::get('rejected', 'DepositController@rejected')->name('rejected');
                Route::get('approved', 'DepositController@approved')->name('approved');
                Route::get('successful', 'DepositController@successful')->name('successful');
                Route::get('details/{id}', 'DepositController@details')->name('details');

                Route::post('reject', 'DepositController@reject')->name('reject');
                Route::post('approve', 'DepositController@approve')->name('approve');
                Route::get('/{scope}/search', 'DepositController@search')->name('search');
       });


        // Report
        Route::get('report/transaction', 'ReportController@transaction')->name('report.transaction');
        Route::get('report/transaction/search', 'ReportController@transactionSearch')->name('report.transaction.search');
        Route::get('report/login/history', 'ReportController@loginHistory')->name('report.login.history');
        Route::get('report/login/ipHistory/{ip}', 'ReportController@loginIpHistory')->name('report.login.ipHistory');


        // WITHDRAW SYSTEM
        Route::name('withdraw.')->prefix('withdraw')->group(function(){
            Route::get('pending', 'WithdrawalController@pending')->name('pending');
            Route::get('approved', 'WithdrawalController@approved')->name('approved');
            Route::get('rejected', 'WithdrawalController@rejected')->name('rejected');
            Route::get('log', 'WithdrawalController@log')->name('log');
            Route::get('via/{method_id}/{type?}', 'WithdrawalController@logViaMethod')->name('method');
            Route::get('{scope}/search', 'WithdrawalController@search')->name('search');
            Route::get('date-search/{scope}', 'WithdrawalController@dateSearch')->name('dateSearch');
            Route::get('details/{id}', 'WithdrawalController@details')->name('details');
            Route::post('approve', 'WithdrawalController@approve')->name('approve');
            Route::post('reject', 'WithdrawalController@reject')->name('reject');


            // Withdraw Method
            Route::get('method/', 'WithdrawMethodController@methods')->name('method.index');
            Route::get('method/create', 'WithdrawMethodController@create')->name('method.create');
            Route::post('method/create', 'WithdrawMethodController@store')->name('method.store');
            Route::get('method/edit/{id}', 'WithdrawMethodController@edit')->name('method.edit');
            Route::post('method/edit/{id}', 'WithdrawMethodController@update')->name('method.update');
            Route::post('method/activate', 'WithdrawMethodController@activate')->name('method.activate');
            Route::post('method/deactivate', 'WithdrawMethodController@deactivate')->name('method.deactivate');
        });


        // Admin Support
        Route::get('tickets', 'SupportTicketController@tickets')->name('ticket');
        Route::get('tickets/pending', 'SupportTicketController@pendingTicket')->name('ticket.pending');
        Route::get('tickets/closed', 'SupportTicketController@closedTicket')->name('ticket.closed');
        Route::get('tickets/answered', 'SupportTicketController@answeredTicket')->name('ticket.answered');
        Route::get('tickets/view/{id}', 'SupportTicketController@ticketReply')->name('ticket.view');
        Route::put('ticket/reply/{id}', 'SupportTicketController@ticketReplySend')->name('ticket.reply');
        Route::get('ticket/download/{ticket}', 'SupportTicketController@ticketDownload')->name('ticket.download');
        Route::post('ticket/delete', 'SupportTicketController@ticketDelete')->name('ticket.delete');


        // Language Manager
        Route::get('/language', 'LanguageController@langManage')->name('language-manage');
        Route::post('/language', 'LanguageController@langStore')->name('language-manage-store');
        Route::delete('/language/delete/{id}', 'LanguageController@langDel')->name('language-manage-del');
        Route::post('/language/update/{id}', 'LanguageController@langUpdatepp')->name('language-manage-update');
        Route::get('/language/edit/{id}', 'LanguageController@langEdit')->name('language-key');
        Route::put('/language/keyword-update/{id}', 'LanguageController@langUpdate')->name('language.key-update');
        Route::post('/language/import', 'LanguageController@langImport')->name('language.import_lang');



        Route::post('store-lang-key/{id}', 'LanguageController@storeLanguageJson')->name('store-lang-key');
        Route::post('delete-lang-key/{id}', 'LanguageController@deleteLanguageJson')->name('delete-lang-key');
        Route::post('update-lang-key/{id}', 'LanguageController@updateLanguageJson')->name('update-lang-key');



        // General Setting
        Route::get('general-setting', 'GeneralSettingController@index')->name('setting.index');
        Route::post('general-setting', 'GeneralSettingController@update')->name('setting.update');
        Route::get('optimize', 'GeneralSettingController@optimize')->name('setting.optimize');

        //Custom CSS
        Route::get('custom-css','GeneralSettingController@customCss')->name('setting.custom.css');
        Route::post('custom-css','GeneralSettingController@customCssSubmit');

        // Logo-Icon
        Route::get('setting/logo-icon', 'GeneralSettingController@logoIcon')->name('setting.logo-icon');
        Route::post('setting/logo-icon', 'GeneralSettingController@logoIconUpdate')->name('setting.logo-icon');

        // Plugin
        Route::get('extensions', 'ExtensionController@index')->name('extensions.index');
        Route::post('extensions/update/{id}', 'ExtensionController@update')->name('extensions.update');
        Route::post('extensions/activate', 'ExtensionController@activate')->name('extensions.activate');
        Route::post('extensions/deactivate', 'ExtensionController@deactivate')->name('extensions.deactivate');


        // Email Setting
        Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email-template.global');
        Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email-template.global');
        Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email-template.setting');
        Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email-template.setting');
        Route::get('email-template/index', 'EmailTemplateController@index')->name('email-template.index');
        Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email-template.edit');
        Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email-template.update');
        Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email-template.sendTestMail');


        // SMS Setting
        Route::get('sms-template/global', 'SmsTemplateController@smsSetting')->name('sms-template.global');
        Route::post('sms-template/global', 'SmsTemplateController@smsSettingUpdate')->name('sms-template.global');
        Route::get('sms-template/index', 'SmsTemplateController@index')->name('sms-template.index');
        Route::get('sms-template/edit/{id}', 'SmsTemplateController@edit')->name('sms-template.edit');
        Route::post('sms-template/update/{id}', 'SmsTemplateController@update')->name('sms-template.update');
        Route::post('email-template/send-test-sms', 'SmsTemplateController@sendTestSMS')->name('email-template.sendTestSMS');



        //Report Bugs
        Route::get('request-report','AdminController@requestReport')->name('request.report');
        Route::post('request-report','AdminController@reportSubmit');

        Route::get('system-info','AdminController@systemInfo')->name('system.info');



        // SEO
        Route::get('seo', 'FrontendController@seoEdit')->name('seo');


        // Frontend
        Route::name('frontend.')->prefix('frontend')->group(function () {


            Route::get('templates', 'FrontendController@templates')->name('templates');
            Route::post('templates', 'FrontendController@templatesActive')->name('templates.active');



            Route::get('frontend-sections/{key}', 'FrontendController@frontendSections')->name('sections');
            Route::post('frontend-content/{key}', 'FrontendController@frontendContent')->name('sections.content');
            Route::get('frontend-element/{key}/{id?}', 'FrontendController@frontendElement')->name('sections.element');
            Route::post('remove', 'FrontendController@remove')->name('remove');

            // Page Builder
            Route::get('manage-pages', 'PageBuilderController@managePages')->name('manage.pages');
            Route::post('manage-pages', 'PageBuilderController@managePagesSave')->name('manage.pages.save');
            Route::patch('manage-pages', 'PageBuilderController@managePagesUpdate')->name('manage.pages.update');
            Route::delete('manage-pages', 'PageBuilderController@managePagesDelete')->name('manage.pages.delete');
            Route::get('manage-section/{id}', 'PageBuilderController@manageSection')->name('manage.section');
            Route::post('manage-section/{id}', 'PageBuilderController@manageSectionUpdate')->name('manage.section.update');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Start User Area
|--------------------------------------------------------------------------
*/

Route::name('user.')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logoutGet')->name('logout');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->middleware('regStatus');

    //Campaign
    Route::get('campaigns','CampaignController@showAll')->name('campaigns');

    Route::get('campaign/details/{slug}/{id}','CampaignController@details')->name('campaign.details');
    Route::post('campaign/details/{slug}/{id}','DonationController@donation');

    Route::post('campaign/donation/insert','DonationController@donationInsert')->name('donation.insert');
    Route::get('campaign/donation/preview','DonationController@preview')->name('donation.preview');


    Route::get('campaign/{id}','CampaignController@filterCampaign')->name('campaign.filter');
    Route::get('price/filter','CampaignController@filterCampaignByPrice')->name('price.filter');
    Route::get('date/filter','CampaignController@filterCampaignByDate')->name('date.filter');
    Route::get('search/filter','CampaignController@searchFilter')->name('search.filter');
    Route::get('campaign/checkbox/filter','CampaignController@campaignFilterByCheckbox')->name('checkbox.filter');

    // success Story
    Route::get('success/details/{slug}/{id}','SuccessStoryController@showBlog')->name('success.details');
    Route::post('success/details/{slug}/{id}','SuccessStoryController@leaveComment');
    Route::get('success/story','SuccessStoryController@blogAll')->name('success.archive');
    Route::get('success/story/search','SuccessStoryController@ajax')->name('success.ajax');

    Route::post('subscribe','SiteController@subscribe')->name('subscribe');
    // About
    Route::get('about','UserController@about')->name('about');
    Route::get('team','UserController@team')->name('team');

    // Comment
    Route::post('campaign/comments','CommentController@comment')->name('campaign.comment');

    // policy
    Route::get('site/{slug}','SiteController@policy')->name('site');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/code-verify', 'Auth\ForgotPasswordController@codeVerify')->name('password.code_verify');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/verify-code', 'Auth\ForgotPasswordController@verifyCode')->name('password.verify-code');
});

Route::name('user.')->prefix('user')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('authorization', 'AuthorizationController@authorizeForm')->name('authorization');
        Route::get('resend-verify', 'AuthorizationController@sendVerifyCode')->name('send_verify_code');
        Route::post('verify-email', 'AuthorizationController@emailVerification')->name('verify_email');
        Route::post('verify-sms', 'AuthorizationController@smsVerification')->name('verify_sms');
        Route::post('verify-g2fa', 'AuthorizationController@g2faVerification')->name('go2fa.verify');

        Route::middleware(['checkStatus'])->group(function () {
            Route::get('dashboard', 'UserController@home')->name('home');
            // Fundrise
            Route::get('campaign','CampaignController@create')->name('fundrise');
            Route::post('campaign','CampaignController@storeCampaign');
            Route::get('campaign/all','CampaignController@showAllFundrise')->name('fundrise.all');

            Route::get('donation/log','DonationController@donationLog')->name('donation.log');
            Route::get('donation/details/{id}','DonationController@donationDetails')->name('donation.details');

            Route::get('campaign/edit/{slug?}/{id?}','CampaignController@editRequest')->name('fundrise.edit');
            Route::post('campaign/edit/{slug?}/{id?}','CampaignController@sendRequest');
            Route::get('campaign/stop/{id}','CampaignController@campaignStop')->name('fundrise.stop');
            Route::get('campaign/complete/{id}','CampaignController@campaignComplete')->name('fundrise.makeComplete');

            Route::get('campaign/delete/{slug}/{id}','CampaignController@delete')->name('fundrise.delete');
            Route::get('campaign/approved','CampaignController@approvedCampaign')->name('fundrise.approved');
            Route::get('campaign/rejected','CampaignController@rejectedCampaign')->name('fundrise.rejected');
            Route::get('campaign/pending','CampaignController@pending')->name('fundrise.pending');
            Route::get('campaign/success','CampaignController@complete')->name('fundrise.complete');
            Route::get('campaign/expired','CampaignController@expired')->name('fundrise.expired');

            Route::get('campaign/details/{slug}/{id}','CampaignController@detailsSingleCampaign')->name('campaign.view');



            Route::get('profile-setting', 'UserController@profile')->name('profile-setting');
            Route::post('profile-setting', 'UserController@submitProfile');
            Route::get('change-password', 'UserController@changePassword')->name('change-password');
            Route::post('change-password', 'UserController@submitPassword');

            //2FA
            Route::get('twofactor', 'UserController@show2faForm')->name('twofactor');
            Route::post('twofactor/enable', 'UserController@create2fa')->name('twofactor.enable');
            Route::post('twofactor/disable', 'UserController@disable2fa')->name('twofactor.disable');


            // Deposit
            Route::any('/payment', 'Gateway\PaymentController@deposit')->name('deposit')->withoutMiddleware(['auth','checkStatus']);
            Route::post('payment/insert', 'Gateway\PaymentController@depositInsert')->name('deposit.insert')->withoutMiddleware(['auth','checkStatus']);
            Route::get('payment/preview', 'Gateway\PaymentController@depositPreview')->name('deposit.preview')->withoutMiddleware(['auth','checkStatus']);
            Route::get('donation/confirm', 'Gateway\PaymentController@depositConfirm')->name('deposit.confirm')->withoutMiddleware(['auth','checkStatus']);

            Route::get('donation/history', 'UserController@depositHistory')->name('deposit.history')->withoutMiddleware(['auth','checkStatus']);
            Route::get('payment/manual', 'Gateway\PaymentController@manualDepositConfirm')->name('deposit.manual.confirm')->withoutMiddleware(['auth', 'checkStatus']);
            Route::post('payment/manual', 'Gateway\PaymentController@manualDepositUpdate')->name('deposit.manual.update')->withoutMiddleware(['auth', 'checkStatus']);


            // Withdraw
            Route::get('/withdraw', 'UserController@withdrawMoney')->name('withdraw');
            Route::post('/withdraw', 'UserController@withdrawStore')->name('withdraw.money');
            Route::get('/withdraw/preview', 'UserController@withdrawPreview')->name('withdraw.preview');
            Route::post('/withdraw/preview', 'UserController@withdrawSubmit')->name('withdraw.submit');
            Route::get('/withdraw/history', 'UserController@withdrawLog')->name('withdraw.history');
        });
    });
});

Route::get('/contact', 'SiteController@contact')->name('contact');
Route::post('/contact', 'SiteController@contactSubmit')->name('contact.send');
Route::get('/change/{lang?}', 'SiteController@changeLanguage')->name('lang');

Route::get('blog/{id}/{slug}', 'SiteController@blogDetails')->name('blog.details');

Route::get('placeholder-image/{size}', 'SiteController@placeholderImage')->name('placeholderImage');

Route::get('/{slug}', 'SiteController@pages')->name('pages');
Route::get('/', 'SiteController@index')->name('home');
Route::get('join-as/volunteer', 'VolunteerController@index')->name('volunteer');
Route::post('join-as/volunteer', 'VolunteerController@volunteerStore')->name('volunteer');
Route::get('volunteer/list', 'VolunteerController@volunteerList')->name('volunteer.list');
Route::get('volunteer/search/filter', 'VolunteerController@volunteerSearch')->name('volunteer.search.filter');
Route::get('volunteer/search/country', 'VolunteerController@volunteerSearchByCountry')->name('volunteer.search.country');
