<?php

namespace App\Controller;
use App\Form\QCMType;
use App\Entity\Questions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Route("/admin")
 */
class QuestionsController extends AbstractController
{
    /**
     * @Route("/question/create",name="admnin.create.question",methods={"GET","POST"})
     */
    public function createQuestion(Request $request)
    {
        $form = $this->createForm(QCMType::class, new Questions());

        return $this->render('questions/create.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
