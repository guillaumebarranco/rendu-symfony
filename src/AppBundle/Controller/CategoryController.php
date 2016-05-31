<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\Type\CategoriesType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller {

    function em() {
        return $this->getDoctrine()->getManager();
    }

    public function listAction() {

        $categorys = $this->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findAll();

        return $this->render('category/list.html.twig', [
            'categorys' => $categorys
        ]);
    }

    public function removeAction(Request $request, Category $category) {
        $this->em()->remove($category);
        $this->em()->flush();

        $this->addFlash('success', 'category supprimé !');

        return $this->redirectToRoute('category_list');
    }

    public function newAction(Request $request) {

        $category = new Category();
        $form = $this->createForm(CategoriesType::class, $category);
        $form->add('submit', SubmitType::class);

        if (isset($request) && $form->handleRequest($request)->isValid()) {

            $this->em()->persist($category);
            $this->em()->flush();

            $this->addFlash('success', 'category créée !');

            return $this->redirectToRoute('category_list');
        }

        return $this->render('category/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editAction(Request $request, Category $category) {

        $form = $this->createForm(CategoriesType::class, $category);
        $form->add('submit', SubmitType::class);

        if ($form->handleRequest($request)->isValid()) {

            $this->em()->flush();

            $this->addFlash('success', 'categorie éditée !');

            return $this->redirectToRoute('category_list');
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }
}
