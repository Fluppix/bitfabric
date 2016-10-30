<?php

namespace Bitaac\Core\Providers;

use Bitaac\Guild\GuildServiceProvider;
use Bitaac\Store\StoreServiceProvider;
use Bitaac\Forum\ForumServiceProvider;
use Bitaac\Player\PlayerServiceProvider;
use Bitaac\Account\AccountServiceProvider;
use Bitaac\Highscore\HighscoreServiceProvider;
use Bitaac\Community\CommunityServiceProvider;

class BitfabricServiceProvider extends AggregateServiceProvider
{
    /**
     * Holds all service providers we want to register.
     *
     * @var array
     */
    protected $providers = [
        SeedServiceProvider::class,
        AppServiceProvider::class,
        AuthServiceProvider::class,
        RouteServiceProvider::class,
        SHAHashServiceProvider::class,
        PlayerServiceProvider::class,
        AccountServiceProvider::class,
        ForumServiceProvider::class,
        CommunityServiceProvider::class,
        HighscoreServiceProvider::class,
        StoreServiceProvider::class,
        GuildServiceProvider::class,
    ];

    /**
     * The binding class names & alias.
     *
     * @var array
     */
    protected $bindings = [
        'account'   => [\Bitaac\Contracts\Account::class   => \Bitaac\Account\Models\Account::class],
        'player'    => [\Bitaac\Contracts\Player::class    => \Bitaac\Player\Models\Player::class],
        'death'     => [\Bitaac\Contracts\Death::class     => \Bitaac\Death\Models\Death::class],
        'online'    => [\Bitaac\Contracts\Online::class    => \Bitaac\Player\Models\Online::class],
        'highscore' => [\Bitaac\Contracts\Highscore::class => \Bitaac\Highscore\Models\Highscore::class],

        // Guild
        'guild'        => [\Bitaac\Contracts\Guild::class       => \Bitaac\Guild\Models\Guild::class],
        'guild.member' => [\Bitaac\Contracts\GuildMember::class => \Bitaac\Guild\Models\GuildMember::class],
        'guild.rank'   => [\Bitaac\Contracts\GuildRank::class   => \Bitaac\Guild\Models\GuildRank::class],
        'guild.invite' => [\Bitaac\Contracts\GuildInvite::class => \Bitaac\Guild\Models\GuildInvite::class],

        // Forum
        'forum.post' => [\Bitaac\Contracts\ForumPost::class => \Bitaac\Forum\Models\ForumPost::class],
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('seed.handler', function ($app) {
            return new \Bitaac\Core\Handlers\SeedHandler($app, collect());
        });

        $this->app->register(config('bitaac.app.theme', \Bitaac\Theme\RetroThemeServiceProvider::class));

        parent::register();
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (config('bitaac.app.https')) {
            $this->app['url']->forceSchema('https');
        }

        $this->publishes([
            __DIR__.'/../Config' => config_path('bitaac'),
        ], 'config');
    }
}
