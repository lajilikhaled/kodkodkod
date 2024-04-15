<?php

namespace App\Controller;

use MailchimpMarketing\ApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailchimpController extends AbstractController
{

    /**
     * @Route("/add-member", name="add_member", methods={"POST"})
     */
    public function addMember(Request $request): Response
    {

        $email = $request->request->get('email');

        $mailchimp = new ApiClient();
        $mailchimp->setConfig([
            'apiKey' => '332480d263b5d177e1cf228633d15fff-us9',
            'server' => 'us9',
        ]);

        $listId = 'e6eda65988';

        $memberData = [
            'email_address' => $email,
            'status' => 'subscribed',
        ];

        try {
            $response = $mailchimp->lists->addListMember($listId, $memberData, true);
            return $this->redirectToRoute('home');
        } catch (\Exception $e) {
            return new Response('Error: ' . $e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
