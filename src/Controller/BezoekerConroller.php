<?php
namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Group;
use App\Entity\GroupCustomer;
use App\Entity\Klant;
use App\Form\BookingType;
use App\Form\GroopCustomerType;
use App\Form\GroupType;
use App\Form\KlantType;
use App\Repository\BookingRepository;
use App\Repository\GroupCustomerRepository;
use App\Repository\GroupRepository;
use App\Repository\KlantRepository;
use App\Repository\VliegveldRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BezoekerConroller extends AbstractController
{
    /**
     * @Route("/",name="home")
     */
    public function index(){
        return $this->render("home.html.twig");
    }

    /**
     * @Route("/account",name="account")
     */
    public function account(KlantRepository $bk){
        $ac=$bk->findOneBy(['id' => $this->getUser()->getId()]);
        return $this->render("user/user.html.twig",[
            "klant"=>$ac
        ]);
    }

    /**
     * @Route("/vliegtuigveld",name="vliegtuigveld")
     */
    public function vliegtuigVeld(VliegveldRepository $vliegveldRepository){
        $vliegveld=$vliegveldRepository->findAll();
        return $this->render("vliegtuigVeld/vliegtuigveldList.html.twig",[
            "vliegveld"=>$vliegveld
        ]);
    }

    /**
     * @Route("/vliegtuigveld/edit/{id}",name="vliegtuigveldEdit")
     */
    public function vliegtuigVeldEdit($id,VliegveldRepository $vliegveldRepository,EntityManagerInterface $em){
        $try=$vliegveldRepository->findOneBy(["id"=>$id]);


        $statusNu=$try->getStatus();
        if ($statusNu==="Actief"){
            $try->setStatus("Non-Actief");

        }else{
            $try->setStatus("Actief");
        }
        $em->persist($try);
        $em->flush();

        return $this->redirectToRoute("vliegtuigveld");
    }

    /**
     * @Route("/booking",name="booking")
     */
    public function booking( KlantRepository $bk){
        $kl=$bk->findOneBy(['id' => $this->getUser()->getId()]);
        return $this->render("booking/booking.html.twig",[
            "klant"=>$kl
        ]);
    }

    /**
     * @Route("delete/boking/{id}",name="bookingDelete")
     */
    public function deleteBooking(Booking $booking,EntityManagerInterface $em):Response{
        $booking->getId();
        $em->remove($booking);
        $em->flush();
        return $this->redirectToRoute("booking");
    }

    /**
     * @Route("/account/edit/{id}",name="edit_account")
     */
    public  function  editAccount(Klant $klant,EntityManagerInterface $em,Request $request){
        $form=$this->createForm(KlantType::class,$klant);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            /** @var Klant $klant */
            $klant=$form->getData()   ;

            $em->persist($klant);
            $em->flush();

            return $this->redirectToRoute('account',[
                'id'=>$klant->getId()
            ]);
        }
        return $this->render('user/userEdit.html.twig',[
            'userForm'=>$form->createView()
        ]);
    }

    /**
     * @Route("/groep",name="Groeplist")
     */
    public function groep(GroupCustomerRepository $gb,GroupRepository $groupRepository){

        $groepCustomer=$gb->findBy(['customer'=>$this->getUser()->getId()]);
        $array=[];
        foreach ($groepCustomer as $groep){
            $id=$groep->getGroop()->getId();
            $groepen=$groupRepository->findOneBy(['id'=>$id]);
            array_push($array,$groepen);
        }
        return $this->render("groop/groopList.html.twig",[
            "groep"=>$array,
        ]);
    }

    /**
     * @Route("/booking/create",name="booking_create")
     */
    public function makeBooking(Request $request,EntityManagerInterface $em,BookingRepository $bookingRepository ){
        $bookings=$bookingRepository->findAll();


        $form=$this->createForm(BookingType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            /** @var Boeking $booking */
            $booking=$form->getData();
            $booking->setKlant($this->getUser());
            $booking->setDatumBooking(new \DateTime());



            $aantalStoel=$booking->getVliegtuigID()->getZitplaats();
            $random=random_int(1, $aantalStoel);
            $booking->setStoel($random);

            $em->persist($booking);
            $em->flush();
            return $this->redirectToRoute("booking");
        }
        return $this->render("booking/createBooking.html.twig",[
            "bookingForm"=>$form->createView()
        ]);
    }

    /**
     * @Route("/create/group",name="createGroop")
     */
    public function group( Request $request,EntityManagerInterface $em){
        $form=$this->createForm(GroupType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            /** @var Group $group */
            $group=$form->getData();
            $group->setStichter($this->getUser());
            $em->persist($group);
            $em->flush();
            $groupCustomer=new GroupCustomer();
            $groupCustomer->setCustomer($group->getStichter());
            $groupCustomer->setGroop($group);
            $em->persist($groupCustomer);
            $em->flush();
            return $this->redirectToRoute("Groeplist");
        }
        return $this->render("groop/createGroop.html.twig",[
            "groepForm"=>$form->createView()
        ]);
    }

    /**
     * @Route("/groopCustomer/create/{id}",name="groopLeden")
     */
    public function groupCustomer($id,Request $request,EntityManagerInterface $em,GroupCustomerRepository $groupCustomerRepository){
        $try=$groupCustomerRepository->findBy(["groop"=>$id]);
        $form=$this->createForm(GroopCustomerType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            /** @var GroupCustomer $groopCustomer */
            $groopCustomer=$form->getData();
            $group=$try->getGroop();
            $groopCustomer->setGroop($group) ;
            if (!$em->getRepository(GroupCustomer::class)->findOneBy(['groop'=> $groopCustomer->getGroop(), 'customer' => $groopCustomer->getCustomer()])){
                $em->persist($groopCustomer);
                $em->flush();
            }
            return $this->redirectToRoute("Groeplist");
        }
        return $this->render("groop/createCustomerGroop.html.twig",[
            "groepCustomerForm"=>$form->createView()
        ]);
    }

    /**
     * @Route("creategroop/booking/{id}",name="test")
     */
    public function makeGroopBooking(GroupCustomerRepository $groupCustomerRepository,$id,Request $request,EntityManagerInterface $em){
        $try=$groupCustomerRepository->findBy(["groop"=>$id]);
        $soloBooking = new Booking();
        $form=$this->createForm(BookingType::class, $soloBooking);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){

            $booking= $form->getData();
            foreach($try as $group) {
                $tempBooking = new Booking();
                $tempBooking->setKlant($group->getCustomer());
                $tempBooking->setDatumBooking(new \DateTime());
                $tempBooking->setDatumVlucht($form->getData()->getDatumVlucht());
                $tempBooking->setVliegtuigID($form->getData()->getVliegtuigID());
                $tempBooking->setVertrekVliegveldId($form->getData()->getVertrekVliegveldId());
                $tempBooking->setEindVliegveldId($form->getData()->getEindVliegveldId());
                $random= random_int(1, 100);
                $tempBooking->setStoel($random);
                $em->persist($tempBooking);
            }
            $em->flush();
            return $this->redirectToRoute("booking");
        }
        return $this->render("booking/createBooking.html.twig",[
            "bookingForm"=>$form->createView()
        ]);
    }
}