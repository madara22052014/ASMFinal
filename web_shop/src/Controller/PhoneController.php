<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Entity\Publisher;
use App\Form\PublisherType;
use App\Form\PhoneType;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

use function PHPUnit\Framework\throwException;

class PhoneController extends AbstractController
{
     /**
     * @Route("/phone", name="phone_list")
     */
    public function listPhone () {
        $phones = $this->getDoctrine()
                       ->getRepository(Phone::class)
                       ->findAll();
    
        return $this->render(
                        "phone/index.html.twig",
                        [
                            'phones' => $phones
                        ]
                     );
    }

    /**
     * @Route("/phone/detail/{id}", name="phone_detail")
     */
    public function detailPhone ($id) {
        $phone = $this->getDoctrine()
                       ->getRepository(Phone::class)
                       ->find($id);

        if ($phone == null) {
            $this->addFlash("Error", "Phone ID in invalid");
            return $this->redirectToRoute("phone_list");
        }

        return $this->render(
                        "phone/detail.html.twig",
                        [
                          'phone' => $phone
                        ]
        );
    }

    
    /**
     * @Route("/phone/delete/{id}", name="phone_delete")
     */
    public function deletePhone ($id)
    {
        $phone = $this->getDoctrine()
                          ->getRepository(Phone::class)
                          ->find($id);
        if($phone == null) {
            $this->addFlash("Error", "Invalid Phone ID");
            return $this->redirectToRoute("phone_list");
        }
        $manager = $this->getDoctrine()
                        ->getManager();
        $manager->remove($phone);
        $manager->flush();
        $this->addFlash("Info", "Phone has been deleted");    
        return $this->redirectToRoute("phone_list");
    }

    /**
     * @Route("/phone/create", name="phone_create")
     */
    public function createPhone (Request $request)
    {
        $phone = new Phone();
        $form = $this->createForm(PhoneType::class,$phone);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $image = $phone->getImage();
            $fileName=md5(uniqid());
            $fileExtension = $image->guessExtension();

            $imageName = $fileName . '.' . $fileExtension;

            try {
                $image->move(
                    $this->getParameter('phone_image'), $imageName
                );
            }
            catch (FileException $e)
            {
                throwException($e);
            }

            $phone->setImage($imageName);
            $manager = $this->getDoctrine()
                            ->getManager();
            $manager->persist($phone);
            $manager->flush();

            

            $this->addFlash("Info", "Phone has been added!");
            return $this->redirectToRoute("phone_list");
        }
        return $this->render(
            "phone/create.html.twig",
            [
                "form" => $form->createView()
            ]
        );
    }

    /**
     * @Route("/phone/update/{id}", name="phone_update")
     */
    public function updatePhone (Request $request, $id)
    {
        $phone = $this->getDoctrine()
                          ->getRepository(Phone::class)
                          ->find($id);
        $form = $this->createForm(PhoneType::class,$phone);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $uploadedFile = $form['Image'] -> getData();
            if ($uploadedFile != null)
            {
                $image = $phone->getImage();
                $fileName = md5(uniqid());
                $fileExtension = $image->guessExtension();
                $imageName = $fileName . '.' . $fileExtension;
                try {
                    $image->move(
                        $this->getParameter('phone_image'), $imageName
                    );
                } catch (FileException $e) {
                    throwException($e);
                }
                $phone->setImage($imageName);
            }
            $manager = $this->getDoctrine()
                            ->getManager();
            $manager->persist($phone);
            $manager->flush();

            $this->addFlash("Info", "Phone has been updated!");
            return $this->redirectToRoute("phone_list");
        }
        return $this->render(
            "phone/update.html.twig",
            [
                'form' => $form->createView(),
            ]
        );

    }


   
}
