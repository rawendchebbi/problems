<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/showUser/{name}', name: 'app_showUser')]
    public function showUser($name)
    {
        return $this->render('user/show.html.twig', ['n' => $name]);
    }

    #[Route('/showlist', name: 'app_showlist')]
    public function list()
    {
        $users = array(
            array('id' => 1, 'name' => 'Victor', 'surname' => 'Hugo', 'dateOfBirth' => new \DateTime('1802-02-26'), 'userStatus' => 'low', 'gender' => 'male'),
            array('id' => 2, 'name' => 'William', 'surname' => 'Shakespeare', 'dateOfBirth' => new \DateTime('1564-04-26'), 'userStatus' => 'high', 'gender' => 'male'),
            array('id' => 3, 'name' => 'Taha', 'surname' => 'Hussein', 'dateOfBirth' => new \DateTime('1889-11-14'), 'userStatus' => 'low', 'gender' => 'male'),
        );

        return $this->render("user/list.html.twig", ['users' => $users]);
    }

    #[Route('/userDetails/{id}', name: 'app_userDetails')]
    public function userDetails($id)
    {
        $user = [
            'id' => $id,
            'name' => 'User',
            'surname' => 'user.surname',
            'dateOfBirth' => new \DateTime('2000-01-01'),
            'userStatus' => 'low',
            'gender' => 'unknown',
        ];

        return $this->render("user/showUser.html.twig", ['user' => $user]);
    }

    #[Route('/Affiche', name: 'app_Affiche')]
    public function Affiche(UserRepository $repository)
    {
        $users = $repository->findAll();

        return $this->render('user/Affiche.html.twig', ['users' => $users]);
    }

    #[Route('/Add', name: 'app_Add')]
    public function Add(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->add('Ajouter', SubmitType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_Affiche');
        }

        return $this->render('user/Add.html.twig', ['f' => $form->createView()]);
    }

    #[Route('/edit/{id}', name: 'app_edit')]
    public function edit(UserRepository $repository, $id, Request $request)
    {
        $user = $repository->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->add('Edit', SubmitType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("app_Affiche");
        }

        return $this->render('user/edit.html.twig', [
            'f' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete($id, UserRepository $repository)
    {
        $user = $repository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('app_Affiche');
    }

    #[Route('/AddStatistique', name: 'app_AddStatistique')]
    public function addStatistique(EntityManagerInterface $entityManager): Response
    {
        $user1 = new User();
        $user1->setName("test");
        $user1->setSurname("test");
        $user1->setDateOfBirth(new \DateTime('2000-01-01'));
        $user1->setUserStatus("low");
        $user1->setGender("unknown");

        $entityManager->persist($user1);
        $entityManager->flush();

        return $this->redirectToRoute('app_Affiche');
    }
}
