<?php

namespace App\Controller;

use App\Entity\Conversion;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{

    private EntityManagerInterface $em;
    private MailerInterface $mailer;
    private LoggerInterface $logger;
    public function __construct(EntityManagerInterface $em, MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->mailer = $mailer;
        $this->logger = $logger;
    }
    #[Route('/{_locale<%app_locales%>}/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $firstname = $request->request->get('firstname');
        $lastname = $request->request->get('lastname');
        $email = $request->request->get('email');
        $phone =   $request->request->get('tel-number');
        $type = $request->request->get('type');
        $entreprise = $request->request->get('enterprise');
        $message = $request->request->get('description');
        $token = $request->request->get('token');

        if($request->isMethod(Request::METHOD_POST)) {

            $conversion = 	new Conversion();
            $conversion->setName($firstname. ' ' . $lastname);
            $conversion->setEmail($email);
            $conversion->setSubject($type);
            $conversion->setMesssage($message);
            $conversion->setPhone($phone);
            $conversion->setCompany($entreprise);

            $this->em->persist($conversion);
            $this->em->flush();

            $email = (new TemplatedEmail())
                ->from('team@kodkodkod.studio')
                ->to(new Address('maxtor3569@gmail.com'), new Address('morgan@kodkodkod.studio'))
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Nouvelle demande')
                //->text('Sending emails is fun again!')
                ->htmlTemplate('emails/devisForm.html.twig')
                ->context([
                    'firstname' => $firstname. ' ' . $lastname,
                    'phone' => $phone,
                    'emailClient' => $email,
                    'entreprise' => $entreprise,
                    'message' => $message,
                    'type' => $type
                ]);


            try {
                $this->mailer->send($email);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                return $this->redirectToRoute('app_contact');

            } catch (TransportExceptionInterface $e) {
                $this->logger->error($e->getMessage());
                return $this->redirectToRoute('app_contact');
            }

            return $this->redirectToRoute('app_contact');

        }
        return $this->render('contact/index.html.twig', [
        ]);
    }

    #[Route('/footer-contact', name: 'app_contact_footer')]
    public function footerForm(Request $request): Response
    {
        $firstname = $request->request->get('firstname');
        $email = $request->request->get('email');
        $message = $request->request->get('description');

        if($request->isMethod(Request::METHOD_POST)) {

            $conversion = 	new Conversion();
            $conversion->setName($firstname);
            $conversion->setEmail($email);
            $conversion->setMesssage($message);

            $this->em->persist($conversion);
            $this->em->flush();

            $email = (new TemplatedEmail())
                ->from('team@kodkodkod.studio')
                ->to(new Address('maxtor3569@gmail.com'), new Address('morgan@kodkodkod.studio'))
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Nouvelle demande')
                //->text('Sending emails is fun again!')
                ->htmlTemplate('emails/devisFooterForm.html.twig')
                ->context([
                    'firstname' => $firstname,
                    'emailClient' => $email,
                    'message' => $message,
                ]);


            try {
                $this->mailer->send($email);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                return new Response(null, 500);

            } catch (TransportExceptionInterface $e) {
                $this->logger->error($e->getMessage());
                return new Response(null, 500);
            }

            return new Response(null, 204);

        }
        return new Response(null, 204);
    }
}
