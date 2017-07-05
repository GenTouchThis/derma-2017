<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('pages/index.html.twig', array());
})->bind('inicio');

$app->get('/laboratorios', function () use ($app) {
    return $app['twig']->render('pages/laboratorios.html.twig', array());
})->bind('laboratorios');

$app->get('/programa', function () use ($app) {
    return $app['twig']->render('pages/programa.html.twig', array());
})->bind('programa');

$app->get('/cdmx', function () use ($app) {
    return $app['twig']->render('pages/cdmx.html.twig', array());
})->bind('cdmx');

$app->get('/sede', function () use ($app) {
    return $app['twig']->render('pages/sede.html.twig', array());
})->bind('sede');

$app->get('/hospedaje', function () use ($app) {
    return $app['twig']->render('pages/hospedaje.html.twig', array());
})->bind('hospedaje');

$app->get('/exposicion', function () use ($app) {
    return $app['twig']->render('pages/exposicion.html.twig', array());
})->bind('exposicion');

$app->get('/galeria', function () use ($app) {
    return $app['twig']->render('pages/galeria.html.twig', array());
})->bind('galeria');

$app->get('/costos', function () use ($app) {
    return $app['twig']->render('pages/costos.html.twig', array());
})->bind('costos');

$app->get('/ponentes', function () use ($app) {
    return $app['twig']->render('pages/ponentes.html.twig', array());
})->bind('ponentes');

$app->get('/contacto', function () use ($app) {
    return $app['twig']->render('pages/contacto.html.twig', array());
})->bind('contacto');

/*active items */
$app->before(function ($request) use ($app) {
    $app['twig']->addGlobal('active', $request->get("_route"));
});

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
