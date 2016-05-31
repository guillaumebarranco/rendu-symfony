<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UserType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;



class UserController extends Controller {

    function em() {
        return $this->getDoctrine()->getManager();
    }

    public function loginAction(Request $request) {

        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'users/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    public function listAction() {

        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();

        return $this->render('users/list.html.twig', [
            'users' => $users
        ]);
    }

    public function newAction(Request $request) {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->add('submit', SubmitType::class);

        if (isset($request) && $form->handleRequest($request)->isValid()) {

            $messageDigestPasswordEncoder= new MessageDigestPasswordEncoder;

            $user->setPassword($messageDigestPasswordEncoder->encodePassword($user->getPassword(), ''));

            $user->setIsAdmin(0);

            $this->em()->persist($user);
            $this->em()->flush();

            $this->addFlash('success', 'User créé !');

            return $this->redirectToRoute('user_list');
        }

        return $this->render('users/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
