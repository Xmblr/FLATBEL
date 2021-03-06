<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Mailer;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Symfony\Bundle\MonologBundle\SwiftMailer;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Symfony\Bundle\SwiftmailerBundle\DependencyInjection\SmtpTransportConfigurator;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

/**
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
class Mailer implements MailerInterface
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var UrlGeneratorInterface
     */
    protected $router;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * Mailer constructor.
     *
     * @param \Swift_Mailer         $mailer
     * @param UrlGeneratorInterface $router
     * @param EngineInterface       $templating
     * @param array                 $parameters
     */
    public function __construct($mailer, UrlGeneratorInterface  $router, EngineInterface $templating, array $parameters)
    {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->templating = $templating;
        $this->parameters = $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function sendConfirmationEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['confirmation.template'];
        $url = $this->router->generate('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), UrlGeneratorInterface::ABSOLUTE_URL);
        $rendered = $this->templating->render($template, array(
            'user' => $user,
            'confirmationUrl' => $url,
        ));
        $this->sendEmailMessage($rendered, $this->parameters['from_email']['confirmation'], (string) $user->getEmail());
    }

    /**
     * {@inheritdoc}
     */
    public function sendResettingEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['resetting.template'];
        $url = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), UrlGeneratorInterface::ABSOLUTE_URL);
        $rendered = $this->templating->render($template, array(
            'user' => $user,
            'confirmationUrl' => $url,
        ));
        $this->sendEmailMessage($rendered, $this->parameters['from_email']['resetting'], (string) $user->getEmail());
    }

    /**
     * @param string       $renderedTemplate
     * @param array|string $fromEmail
     * @param array|string $toEmail
     */
    protected function sendEmailMessage($renderedTemplate, $fromEmail, $toEmail)
    {
        // Create the Transport
        $transport = Swift_SmtpTransport::newInstance('smtp.mail.ru', 465, 'ssl')
            ->setUsername('flatbel@mail.ru')
            ->setPassword('kvartira147')
        ;

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);


        // Render the email, use the first line as the subject, and the rest as the body
        $renderedLines = explode("\n", trim($renderedTemplate));
        $subject = array_shift($renderedLines);
        $body = implode("\n", $renderedLines);

        $message = Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($fromEmail)
            ->setTo($toEmail)
            ->setBody($body);

        //$this->mailer->send($message);

//        // Create the Transport
//        $transport = Swift_SmtpTransport::newInstance('smtp.mail.ru', 465, 'ssl')
//            ->setUsername('flatbel@mail.ru')
//            ->setPassword('kvartira147')
//        ;
//
//        // Create the Mailer using your created Transport
//        $mailer = Swift_Mailer::newInstance($transport);
//
//        // Create a message
//        $message = Swift_Message::newInstance('Wonderful Subject')
//            ->setFrom(array('flatbel@mail.ru' => 'John Doe'))
//            ->setTo(array('mkirill97@mail.ru', 'mkirill97@gmail.com' => 'A name'))
//            ->setBody('Here is the message itself')
//        ;

        // Send the message
        $numSent = $mailer->send($message);
    }
}
