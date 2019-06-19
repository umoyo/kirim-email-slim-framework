<?php

use Slim\App;
use Slim\Slim;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) 

{
    $container = $app->getContainer();
    /*
    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
    */

 $masuk_email = new \Swift_SmtpTransport('smtp.mailtrap.io', 2525, '');
 $masuk_email ->setUsername('9fa2c9138f6699')->setPassword('ce78083430a853');

 $app->post("/kirimEmail",function(Request $request, Response $response) use ($app,$masuk_email)
 { 
    $sudah_masuk = new \Swift_Mailer($masuk_email);
    // membuat email baru
    $ambil_data = $request->getParsedBody();
    $surat = new \Swift_Message($ambil_data["subjek"]);
    $surat  ->setFrom(array($ambil_data["email_saya"] => 'saya'))
            ->setTo(array($ambil_data["email_kamu"] => 'kekamu'))
            ->setBody($ambil_data["isi_email"])
            ->setContentType("text/html");
    // mengirimkan email
    if ($sudah_masuk->send($surat))
        {echo "email terkirim\n";}
    else
        {echo "gagal dikirim\n";}
 });

};
