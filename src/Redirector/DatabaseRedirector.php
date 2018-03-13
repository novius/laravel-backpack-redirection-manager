<?php

namespace Novius\Backpack\RedirectionManager\Redirector;

use Spatie\MissingPageRedirector\Redirector\Redirector;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DatabaseRedirector
 *
 * @package Novius\Backpack\RedirectionManager\Redirector
 */
class DatabaseRedirector implements Redirector
{
    /**
     * Returns the map of redirects
     *
     * @param Request $request
     * @return array
     */
    public function getRedirectsFor(Request $request): array
    {
        $model = config('missing-page-redirector.redirector_model');

        return $model::select('to', 'from')->get()->pluck('to', 'from')->toArray();
    }
}
