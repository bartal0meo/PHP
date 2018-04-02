<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Calculate;
use AppBundle\Entity\PageInfo;
use AppBundle\Forms\Page;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\PageInfoShow;
use AppBundle\Entity\PageInfoDescription;


/**
 * @Route("calculate",name="add_page")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/add", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $repo = $this->get('app.entity.repository_proposal');
        $propsal = $repo->findOneBy(array('id'=>1));
        $page = new PageInfoShow();
        $page->setTitle("Title");
        $page->setDescription("Desc");

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'page' => $page,
            'proposal'=>$propsal,
            'top_url'=>$request->getBaseUrl()
        ]);
    }

    /**
     * @Route("/", name="navbar")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function navbarAction()
    {
        return $this->render('default/navbar.html.twig');
    }

    /**
     * @Route("/show/{id}",name="show")
     */
    public function showAction(Request $request, $id)
    {
        $page = new PageInfoDescription();
        $page->setTitle("Title : " . $id);
        $page->setDescription("Desc");


        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'page' => $page
        ]);
    }

    /**
     * @Route("calcadd",name="add_page")
     */
    public function addAction(Request $request){

        $pageInfo = new PageInfo();
        echo $pageInfo;
        $form = $this->createForm(Page::class,$pageInfo);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $pageInfo = $form->getData();

            var_dump($pageInfo);

            exit();


        }


        return $this->render('default/add.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("calculateform",name="calculateform")
     */
    public function calculateAction(Request $request){



        $calculate = new Calculate();
        $form = $this->createForm(\AppBundle\Forms\Calculate::class,$calculate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $calculate = $form->getData();

            //Todo send email
            //Todo save db
            //Todo save to file
            var_dump($calculate);
            exit();

        }


        return $this->render('default/calculate.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/proposal",name="proposal")
     */
    public function proposalAction(Request $request){
        $aData = array('status'=>1,'info'=>'Wszystko jest ok');
        echo json_encode($aData);
        exit();
    }



}
