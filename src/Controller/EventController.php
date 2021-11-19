<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Event;
use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;
use App\Controller\TemoignageController;
class EventController extends AbstractController
{
   // TemoignageController $temoignageC;
    /**
     * @Route("/event", name="event")
     */
    public function index(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
    /**
     * @Route("/event/add", name="event_add")
     */
    public function AddEvent(Request $req): Response
    {
        $bevent = new Event();
        $form=$this->createForm(EventType::class,$bevent);
        $form->add('save',SubmitType::class);
    $form->HandleRequest($req);
    if($form->isSubmitted()&& $form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $em->persist($bevent);
        $em->flush();
        return $this->redirectToRoute('AfficheE');


    }
        return $this->render('event/ajoutevent.html.twig', [
            'formE' => $form->createView(),
            'controller_name' =>'Event',
        ]);
    }
    /**
     * @param EventRepository $repository
     * @return Response
     * @Route ("/Affiche", name="AfficheE")
     */
    function Affiche(EventRepository $repository ){
        $event=$repository->findAll();
        return $this->render('/event/affiche_event.html.twig',
            [
                'ee'=>$event
            ]);
    }






    /**
     * @Route("/Update/{id}",name="updateE")
     */
    function Update(EventRepository $repository,$id,Request $request)
    {
        $event = $repository->find($id);
        $form = $this->createForm(EventType::class, $event);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("AfficheE");
        }
        return $this->render('event/event_update.html.twig',
            [
                'formE' => $form->createView(),
                'controller_name' =>'Event',
            ]);
    }

    /**
     * @param $id
     * @param EventRepository $rep
     * @Route ("/Delete/{id}", name="deleteE")
     */
    function Delete($id,EventRepository $rep){
        $event=$rep->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('AfficheE');

    }

    /**
     * @param EventRepository $repository
     * @return Response
     * @Route ("/Affichee", name="AfficheEe")
     */
    function Affichee(EventRepository $repository ){
        $event=$repository->findAll();
        return $this->render('/event/eventUser.html.twig',
            [
                'eee'=>$event
            ]);
    }



}
