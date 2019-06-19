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

$transport = new \Swift_SmtpTransport('smtp.mailtrap.io', 2525, '');
$transport->setUsername('9fa2c9138f6699')->setPassword('ce78083430a853');

$app->post("/kirimEmail",function(Request $request, Response $response) use ($app,$transport) 
{
$new_email = $request->getParsedBody();
$mailer = new \Swift_Mailer($transport);
// Create a message
$message = new \Swift_Message($new_email["subjek"]);
$message ->setFrom(array($new_email["email_saya"] => 'saya'))
         ->setTo(array($new_email["email_kamu"] => 'kekamu'))
         ->setBody($new_email["isi_email"])
         ->setContentType("text/html");

// Send the message
if ($mailer->send($message))
  {echo "email terkirim\n";}
else
 {echo "gagal dikirim\n";}

});

};
