<?php

return [

    /*
     * This is the model used by the database redirector
     */
    'redirector_model' => \Novius\Backpack\RedirectionManager\Models\Redirection::class,

    /*
     * This is the class responsible for providing the URLs which must be redirected.
     * The only requirement for the redirector is that it needs to implement the
     * `Spatie\MissingPageRedirector\Redirector\Redirector`-interface
     */
    'redirector' => \Novius\Backpack\RedirectionManager\Redirector\DatabaseRedirector::class,

];
