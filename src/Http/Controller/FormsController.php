<?php namespace Anomaly\FormsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Contracts\Container\Container;
use Illuminate\Routing\Redirector;

/**
 * Class FormsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FormsModule\Http\Controller
 */
class FormsController extends PublicController
{

    /**
     * Handle the form POST.
     *
     * @param Redirector $redirect
     * @param            $form
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function handle(Container $container, Redirector $redirect)
    {
        $builder = $container->make('anomaly.module.forms::forms.' . $this->route->parameter('form'));

        $response = $builder
            ->build()
            ->post()
            ->getFormResponse();

        $builder->flash();

        if ($builder->hasFormErrors()) {
            return $redirect->back();
        }

        return $response;
    }
}
