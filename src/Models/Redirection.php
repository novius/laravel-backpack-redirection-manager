<?php

namespace Novius\Backpack\RedirectionManager\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\MissingPageRedirector\Redirector\Redirector;
use Symfony\Component\HttpFoundation\Request;

class Redirection extends Model implements Redirector
{
    use CrudTrait;

    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    protected static $moviePatternFR = '/^\/Ressources\/Base-Films\/\(movie_id\)\/([0-9]+)\/\(title\)\/(.+)$/';
    protected static $moviePatternEN = '/^\/en\/Resources\/Film-Database\/\(movie_id\)\/([0-9]+)\/\(title\)\/(.+)$/';

    protected static $cinemaPatternFR = '/^\/Le-reseau\/Cinemas-du-reseau\/\(cinema_id\)\/([0-9]+)\/\(cinema\)\/(.+)$/';
    protected static $cinemaPatternEN = '/^\/en\/Network\/Network-Cinemas\/\(cinema_id\)\/([0-9]+)\/\(cinema\)\/(.+)$/';

    protected $table = 'redirections';
    protected $primaryKey = 'id';
    protected $fillable = [
        'from',
        'to',
    ];

    public function getRedirectsFor(Request $request): array
    {
        $urlPath = parse_url($request->getUri(), PHP_URL_PATH);
        // 301 : old movies URL
        if (preg_match(static::$moviePatternFR, $urlPath) || preg_match(static::$moviePatternEN, $urlPath)) {
            return $this->getMovieRedirection();
        }
        // 301 : old cinemas URL
        if (preg_match(static::$cinemaPatternFR, $urlPath) || preg_match(static::$cinemaPatternEN, $urlPath)) {
            return $this->getCinemaRedirection();
        }

        return \DB::table('redirections')->select(['to', 'from'])->get()->pluck('to', 'from')->toArray();
    }

    /**
     * The current route match with old website movie URL : return an associative array with old_url => new_url
     *
     * @return array
     */
    protected function getMovieRedirection(): array
    {
        $segments = collect(\Illuminate\Support\Facades\Request::segments());
        $movieId = $segments->first(function ($value, $key) {
            return (int) $value > 0;
        });

        // Find the original movie
        $originalMovie = \App\Models\Original\Movie::find($movieId);
        // Set context to EN if needed
        if ($segments->first() === 'en') {
            App::setLocale('en');
        }

        $segments->pop();
        $segments->push('{title}');

        return [
            implode($segments->toArray(), '/') => $originalMovie->getPageLink(),
        ];
    }

    /**
     * The current route match with old website cinema URL : return an associative array with old_url => new_url
     *
     * @return array
     */
    protected function getCinemaRedirection(): array
    {
        $segments = collect(\Illuminate\Support\Facades\Request::segments());
        $cinemaId = $segments->first(function ($value, $key) {
            return (int) $value > 0;
        });

        // Find the original cinema
        $originalCinema = \App\Models\Original\Cinema::find($cinemaId);
        // Set context to EN if needed
        if ($segments->first() === 'en') {
            App::setLocale('en');
        }

        $segments->pop();
        $segments->push('{title}');

        return [
            implode($segments->toArray(), '/') => $originalCinema->getPageLink(),
        ];
    }
}
