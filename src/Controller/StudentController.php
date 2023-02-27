<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
   
    #[Route('/student', name: 'app_student')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo=$doctrine->getRepository(Student::class);

        $students=$repo->findAll();

        return $this->render('student/index.html.twig', [
            'students' => $students,
        ]);
    }


    #[Route('/students', name:'app_index')]
    public function index2(): Response{
        return new Response("Bonjour Mes Etudiants");
    } 


    #[Route('/deleteStudent/{id}', name:'app_delete')]
    public function deleteStudent($id , ManagerRegistry $mngr) {

        $student = $mngr->getRepository(Student::class)->find($id);

        $em=$mngr->getManager();

        $em->remove($student);
        $em->flush();

        return $this->redirectToRoute('app_student');

    }


    #[Route('/addstudent', name:'app_delete')]
    public function addStudent(ManagerRegistry $mngr){


        $student = new Student();
        $student->setUsernamr("nothing");
        $student->setEmail("nothing@gmail.com");


        $em=$mngr->getManager();

        $em->persist($student);
        $em->flush();

        return $this->redirectToRoute('app_student');

    }


}
