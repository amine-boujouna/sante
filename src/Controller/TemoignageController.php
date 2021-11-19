<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Temoignage;
use App\Form\TemoignageType;
use App\Repository\TemoignageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\CommentaireController;

use Symfony\Component\Routing\Annotation\Route;

class TemoignageController extends AbstractController
{
    /**
     * @Route("/temoignage", name="temoignage")
     */
    public function index(): Response
    {
        return $this->render('temoignage/index.html.twig', [
            'controller_name' => 'TemoignageController',
        ]);
    }

    /**
     * @param TemoignageRepository $repository
     * @return Response
     * @Route ("/AfficheeUF", name="AfficheUEe")
     */
    function Affichee(TemoignageRepository $repository )
    {
        $temoi=$repository->findAll();
        return $this->render('/temoignage/afficheUF.html.twig',  [
            'ee'=>$temoi
        ]);

    }
    /**
     * @Route("/temoi/add", name="temoi_add")
     */
    public function AddEvent(Request $req): Response
    {
        $bevent = new Temoignage();
        $form=$this->createForm(TemoignageType::class,$bevent);
        $form->add('save',SubmitType::class);
        $form->HandleRequest($req);
        if($form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($bevent);
            $em->flush();
            return $this->redirectToRoute('AfficheUEe');


        }
        return $this->render('temoignage/ajoutT.html.twig', [
            'formF' => $form->createView()
        ]);
    }

    /**
     * @Route("/UpdateT/{id}",name="updateT")
     */
    function Update(TemoignageRepository $repository,$id,Request $request)
    {
        $temoi = $repository->find($id);
        $form = $this->createForm(TemoignageType::class, $temoi);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("AfficheUEe");
        }
        return $this->render('temoignage/updateTemoignage.html.twig',
            [
                'formF' => $form->createView()

            ]);
    }

    /**
     * @param $id
     * @param TemoignageRepository $rep
     * @Route ("/DeleteT/{id}", name="deleteT")
     */
    function Delete($id,TemoignageRepository $rep){
        $temoi=$rep->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($temoi);
        $em->flush();
        return $this->redirectToRoute('AfficheUEe');

    }


    /**
     * @param TemoignageRepository $repository
     * @return Response
     * @Route ("/AfficheeADF", name="AfficheADEe")
     */
    function AfficheeTA(TemoignageRepository $repository )
    {
        $temoi=$repository->findAll();
        return $this->render('/temoignage/afficheTemoignageA.html.twig',  [
            'eee'=>$temoi
        ]);

    }

    /**
     * @param $id
     * @param TemoignageRepository $rep
     * @Route ("/DeleteAdT/{id}", name="deleteADMINT")
     */
    function DeleteADT($id,TemoignageRepository $rep){
        $temoi=$rep->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($temoi);
        $em->flush();
        return $this->redirectToRoute('AfficheADEe');

    }


}
