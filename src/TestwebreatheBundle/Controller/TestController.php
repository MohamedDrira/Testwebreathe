<?php


namespace TestwebreatheBundle\Controller;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TestwebreatheBundle\Entity\Operations;
use TestwebreatheBundle\Entity\User;
use TestwebreatheBundle\Entity\Vehicule;
use TestwebreatheBundle\Form\OperationsType;
use TestwebreatheBundle\Form\UserType;
use TestwebreatheBundle\Form\VehiculeType;


class TestController extends Controller
{
    function LoginAction(Request $request)
    {
        $user = new User();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($user)
            ->add('utilisateur')
            ->add('motdepasse')
            ->add('Login', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $userToLogin= $em ->getRepository(User::class)->findUser($form["utilisateur"]->getData(),$form["motdepasse"]->getData());
            if($userToLogin!=null) {
                $users= $em ->getRepository(User::class)->findAll();
                return $this->redirectToRoute('Tableau_De_Bord', array('users'=>$users));
            }
        }
        return $this->render('@Testwebreathe/Testwebreathe/User/Login.html.twig',array('form'=>$form->createView()));
    }

    function TableauDeBordAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Operations = $em ->getRepository(Operations::class)->findBy(array(),array('id'=>'desc'));
        return $this->render('TestwebreatheBundle:Testwebreathe/Vehicule:Tableaudebord.html.twig',array('Operation'=>$Operations));
    }

    function AfficherUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em ->getRepository(User::class)->findBy(array(),array('id'=>'desc'));
        return $this->render('@Testwebreathe/Testwebreathe/User/AfficherUsers.html.twig',array('users'=>$user));
    }

    function AjouterUserAction(Request $Request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($Request);
        $em = $this->getDoctrine()->getManager();
        $users = $em ->getRepository(User::class)->findBy(array(),array('id'=>'desc'));
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('Affihcer_Users');
        }
        return $this->render('@Testwebreathe/Testwebreathe/User/AjouterUser.html.twig', array('form' => $form->createView(),'users'=>$users));
    }

    function SupprimerUserAction(Request $request)
    {
        $Id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $user= $em ->getRepository(User::class)->find($Id);
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('Affihcer_Users');
    }

    function AfficherVehiculeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Vehicule = $em ->getRepository(Vehicule::class)->findBy(array(),array('id'=>'desc'));
        return $this->render('TestwebreatheBundle:Testwebreathe/Vehicule:AfficherVehicule.html.twig',array('Vehicules'=>$Vehicule));
    }

    function AjouterVehiculeAction(Request $Request)
    {
        $Vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $Vehicule);
        $form->handleRequest($Request);
        $em = $this->getDoctrine()->getManager();
        $Vehicules = $em ->getRepository(Vehicule::class)->findBy(array(),array('id'=>'desc'));
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Vehicule);
            $em->flush();
            return $this->redirectToRoute('Afficher_Vehicule');
        }
        return $this->render('@Testwebreathe/Testwebreathe/Vehicule/AjouterVehicule.html.twig', array('form' => $form->createView(),'Vehicules'=>$Vehicules));
    }

    function SupprimerVehiculeAction(Request $request)
    {
        $Id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $vehicule= $em ->getRepository(Vehicule::class)->find($Id);
        $em->remove($vehicule);
        $em->flush();
        return $this->redirectToRoute('Afficher_Vehicule');
    }

    function AfficherOperationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Operations = $em ->getRepository(Operations::class)->findBy(array(),array('id'=>'desc'));
        return $this->render('TestwebreatheBundle:Testwebreathe/Operation:AfficherOperations.html.twig',array('Operation'=>$Operations));
    }

    function AfficherOperationByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Operations=$em->getRepository('TestwebreatheBundle:Operations')->findOperation($id);
        if ($Operations == null)
        {
            return $this->render('@Testwebreathe/Testwebreathe/Operation/AfficherOperations.html.twig',array('Operation'=>$Operations));
        }
        return $this->render('TestwebreatheBundle:Testwebreathe/Operation:AfficherOperations.html.twig',array('Operation'=>$Operations));
    }

    function AjouterOperationAction(Request $Request)
    {
        $Operation = new Operations();
        $form = $this->createForm(OperationsType::class, $Operation);
        $form->handleRequest($Request);
        $em = $this->getDoctrine()->getManager();
        $Operations = $em ->getRepository(Operations::class)->findBy(array(),array('id'=>'desc'));
        if ($form->isValid()) {
            $file = $Operation->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('brochures_directory'),$fileName);
            $Operation->setImage($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($Operation);
            $em->flush();
            return $this->redirectToRoute('Afficher_Operations');
        }
        return $this->render('TestwebreatheBundle:Testwebreathe/Operation:AjouterOperation.html.twig', array('form' => $form->createView(),'Operations'=>$Operations));
    }
}