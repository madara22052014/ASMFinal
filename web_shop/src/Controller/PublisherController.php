<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Entity\Publisher;
use App\Form\PublisherType;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PublisherController extends AbstractController
{
    /**
     * @Route("/publisher", name="publisher_list")
     */
    public function listPublisher () {
        $publishers = $this->getDoctrine()
                              ->getRepository(Publisher::class)
                              ->findAll();
        return $this->render(
                        "publisher/index.html.twig",
                        [
                            'publishers' => $publishers,
                        ]
                     );
    }

    /**
     * @Route("/publisher/detail/{id}", name="publisher_detail")
     */
    public function detailPublisher ($id) {
        $publisher = $this->getDoctrine()
                       ->getRepository(Publisher::class)
                       ->find($id);

        if ($publisher == null) {
            $this->addFlash("Error", "Publisher ID in invalid");
            return $this->redirectToRoute("publisher_list");
        }

        return $this->render(
                        "publisher/detail.html.twig",
                        [
                          'publisher' => $publisher,
                        ]
        );
    }

    
    /**
     * @Route("/publisher/delete/{id}", name="publisher_delete")
     */
    public function deletePublisher ($id)
    {
        $publisher = $this->getDoctrine()
                          ->getRepository(Publisher::class)
                          ->find($id);
        if($publisher == null) {
            $this->addFlash("Error", "Invalid Publisher ID");
            return $this->redirectToRoute("publisher_list");
        }
        $manager = $this->getDoctrine()
                        ->getManager();
        $manager->remove($publisher);
        $manager->flush();
        $this->addFlash("Info", "Publisher has been deleted");    
        return $this->redirectToRoute("publisher_list");
    }

    /**
     * @Route("/publisher/create", name="publisher_create")
     */
    public function createPublisher (Request $request)
    {
        $publisher = new Publisher();
        $form = $this->createForm(PublisherType::class,$publisher);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()
                            ->getManager();
            $manager->persist($publisher);
            $manager->flush();

            $this->addFlash("Info", "Publisher has been added!");
            return $this->redirectToRoute("publisher_list");
        }
        return $this->render(
            "publisher/create.html.twig",
            [
                "form" => $form->createView()
            ]
        );
    }

    /**
     * @Route("/publisher/update/{id}", name="publisher_update")
     */
    public function updatePublisher (Request $request, $id)
    {
        $publisher = $this->getDoctrine()
                          ->getRepository(Publisher::class)
                          ->find($id);
        $form = $this->createForm(PublisherType::class,$publisher);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()
                            ->getManager();
            $manager->persist($publisher);
            $manager->flush();

            $this->addFlash("Info", "Publisher has been updated!");
            return $this->redirectToRoute("publisher_list");
        }
        return $this->render(
            "publisher/update.html.twig",
            [
                "form" => $form->createView()
            ]
        );
    }
   
}
