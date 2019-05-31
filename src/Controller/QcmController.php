<?php

namespace App\Controller;
use App\Entity\Answers;
use App\Entity\Questions;
use App\Form\AnswerType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Event\SubmitEvent;
class QcmController extends AbstractController
{
    /**
     * @Route("/", name="home",methods={"GET","POST"})
     */
    public function index(Request $request):Response
    {
        $repositoryQuestions = $this->getDoctrine()->getRepository(Questions::class);
        $question = $repositoryQuestions->findAll();
        $repositoryAnswers = $this->getDoctrine()->getRepository(Answers::class);
        $answers = $repositoryAnswers->findAll();


        $form = $this->createForm(AnswerType::class, new Answers());

        $form->handleRequest($request);
        if ($form->getClickedButton() && 'Submit'===$form->getClickedButton()->getName())
        {
            $manager= $this->getDoctrine()->getManager();
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('stat');
        }


        return $this->render('QCM/home.html.twig',[
            'title' => 'QCM',
            'questions' => $question,
            'answers' => $answers,
            'form' => $form->createView(),


        ]);
    }
    /**
     * @Route("/stat", name="stat", methods={"GET","POST"} )
     */
    public function stat()
    {
        $repositoryQuestions = $this->getDoctrine()->getRepository(Questions::class);
        $question = $repositoryQuestions->findAll();
        $repositoryAnswers = $this->getDoctrine()->getRepository(Answers::class);
        $answers = $repositoryAnswers->findAll();

        return $this->render('Stat/stat.html.twig',[
           'title' => 'Statistics',
            'question'=>$question,
            'answer'=>$answers,

        ]);
    }


}