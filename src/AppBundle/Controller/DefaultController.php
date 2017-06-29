<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ingredients;
use AppBundle\Entity\Recipes;
use AppBundle\Entity\Tags;
use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use AppBundle\Form\CommentType;
use AppBundle\Form\LoginType;
use AppBundle\Form\RateType;
use AppBundle\Form\RegistrationType;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Comments;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }
    /**
     * @Route("/test")
     */
    public function testAction()
    {
        $messageGenerator=$this->container->get('app.message_generator');

        $message = $messageGenerator->getHappyMessage();
        $this->addFlash('success',$message);
        return new Response($message);
    }

    /**
     * @Route("/test2")
     */
    public function test2()
    {
        $rate_recipe=$this->container->get('app.rate_recipe');
        $db_connect=$rate_recipe->lookSomething(2);
        return new Response($db_connect);
    }

    /**
     * @Route("dodaj/tagi")
     */
    public function tagAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Recipes');
        $recipes = $repository->find(4);

        $tag=new Tags();
        $tag->setTag('#ostre');
        //$tag->addRecipe($recipes);
        $recipes->addTag($tag);

        $em = $this->getDoctrine()->getManager();
        $em->persist($tag);
        $em->persist($recipes);
        $em->flush();


        return new Response('Dodano taga dla przepisu id= '.$recipes->getId());

    }

    /**
     * @Route("przepisy/dwa/dodanykomentarz/{param}")
     */
    public function addcommentAction($param)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Recipes');
        $recipes = $repository->find($param);


        $comment=new Comments();
        $comment->setComment($_POST['comment']);
        $comment->setCreatedAdd(new \DateTime("now"));
        $recipes->addComment($comment);
        $comment->setRecipes($recipes);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->persist($recipes);
        $em->flush();

        //Pobranie wszystkich przepisów
        $em=$this->getDoctrine()->getManager();
        $recipes=$em->getRepository('AppBundle:Recipes')->find($param);
        if (!$recipes) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }



        $collection = $recipes->getIngredients();

        $tags = $recipes->getTag();

        $comments=$recipes->getComments();

        return $this->render('recipes/przepis.html.twig',['ingredients'=>$collection,'recipes'=>$recipes,'tags'=>$tags, 'comments'=>$comments]);
    }
    /**
     * @Route("dodaj/przepis/")
     */
    public function addrecipeAction()
    {
        $recipe = new Recipes();
        $recipe->setNameRecipe('schabowy');
        $recipe->setMinus(0);
        $recipe->setPlus(0);
        $recipe->setDescription('Lorem ipsum dolor sit amet. Nulla la faucibus dictum. Aenean vel justo et mauris lacinia porttitor. Aenean ullamcorper a dolor et tincidunt. Duis eget arcu ex. Phasellus ut fermentum orci, vel gravida augue. Suspendisse at dapibus risus. Quisque ut ornare nulla, eu tincidunt metus. Etiam varius elit massa, in aliquam risus sodales ut. Etiam in magna odio. Sed eu eleifend enim. Vestibulum tristique tortor et ante dignissim, a gravida nisi vulputate. Morbi semper aliquam ex id rutrum. Suspendisse ut diam ac felis luctus vulputate. Donec porttitor, ex a semper ornare, lorem felis imperdiet sem, eget venenatis odio ex aliquam sapien. Quisque suscipit felis quis justo congue condimentum. Praesent a tortor tellus. ');
        $recipe->setMydisplay(true);
        $recipe->setCreatedAdd(new \DateTime("now"));

        $ingredient=new Ingredients();
        $ingredient1=new Ingredients();
        $ingredient2=new Ingredients();
        $ingredient3=new Ingredients();

        $ingredient->setNameIngredient('jajka');
        $ingredient1->setNameIngredient('mleko');
        $ingredient2->setNameIngredient('cukier');
        $ingredient3->setNameIngredient('woda');

        $ingredient->setRecipes($recipe);
        $ingredient1->setRecipes($recipe);
        $ingredient2->setRecipes($recipe);
        $ingredient3->setRecipes($recipe);

        $em = $this->getDoctrine()->getManager();

        $em->persist($ingredient);
        $em->persist($ingredient1);
        $em->persist($ingredient2);
        $em->persist($ingredient3);
        $em->persist($recipe);
        $em->flush();

        return new Response('Dodano przepis id=  '.$recipe->getId());
        //return $this->render('default/index.html.twig');
    }
    /**
     * @Route("przepisy/")
     */
    public function recipesAction()
    {
       // $repository = $this->getDoctrine()->getRepository('AppBundle:Recipes');
        //$recipe = $repository->findAll();

        //$recipe = $this->getDoctrine()->getRepository('AppBundle:Recipes')->find(1);
/*
        if (!$recipe) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
*/
       // $recipes=$recipe->getNameRecipe();
        $recipes=[];
        for($i=1;$i<6;$i++)
        {
            $recipe = $this->getDoctrine()->getRepository('AppBundle:Recipes')->find($i);
            $recipes[$i-1]=$recipe->getNameRecipe();
        }

        return $this->render('recipes/show.html.twig',['recipes'=>$recipes]);
    }
    /**
     * @Route("przepisy/dwa/")
     */
    public function recipeAction()
    {
      //  $repository = $this->getDoctrine()->getRepository('AppBundle:Recipes');
       // $recipes = $repository->findAll();

        $em=$this->getDoctrine()->getManager();
        $recipes=$em->getRepository('AppBundle:Recipes')->findmydisplay();
                if (!$recipes) {
                    throw $this->createNotFoundException(
                        'No product found for id '
                    );
                }
        return $this->render('recipes/show1.html.twig', array('recipes'=>$recipes));
    }
    /**
     * @Route("przepisy/dwa/{param}", name="dish")
     */
    public function DishAction($param,Request $request)
    {
/*
        $repository = $this->getDoctrine()->getRepository('AppBundle:Ingredients');
        $ingredients= $repository->findBy(array('recipes'=>$param));

        $repository2 = $this->getDoctrine()->getRepository('AppBundle:Recipes');
        $recipes2 = $repository2->find($param);
*/
        $repository2 = $this->getDoctrine()->getRepository('AppBundle:Recipes');
        /**
         * @var $recipes2 Recipes
         */
        $recipes2 = $repository2->find($param);

        $ingredients = $recipes2->getIngredients();

        $tags = $recipes2->getTag();

        $comments=$recipes2->getComments();
        //Wystawienie oceny
        $form3=$this->createForm(RateType::class,$recipes2);
        $form3->handleRequest($request);

       // if ($form3->isSubmitted() && $form3->getName())
        if( $form3->get('minus')->isClicked())
        {
           // $form3->get('minus')->isClicked();
            $rate_recipe=$this->container->get('app.rate_recipe');
            $rate_recipe->change_minus($param);
            return $this->redirectToRoute('dish',['param'=>$param]);
        }
        if($form3->get('plus')->isClicked())
        {
            $rate_recipe=$this->container->get('app.rate_recipe');
            $rate_recipe->change_plus($param);

            return $this->redirectToRoute('dish',['param'=>$param]);
        }




        //skorzystanie z encji komentarza
        $comment=new Comments();
        $comment->setComment('Wpisz komentarz');
        $comment->setRecipes($recipes2);

        $form=$this->createFormBuilder($comment)
            ->add('comment',TextType::class,array('label'=>false,'required'=>false))
            ->add('dodaj', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $comment->setCreatedAdd(new \DateTime("now"));
            $comment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
           return $this->redirectToRoute('dish',['param'=>$param]);
        }

        //dodanie kometarza wykorzystując własną klasę

        $comment1=new Comments();
        $comment1->setComment('Tu wpisz swój komentarz');
        $comment1->setRecipes($recipes2);
        $form2=$this->createForm(CommentType::class,$comment1);
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid())
        {
            $comment1->setCreatedAdd(new \DateTime("now"));
            $comment1 = $form2->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment1);
            $em->flush();
            return $this->redirectToRoute('dish',['param'=>$param]);
        }

            return $this->render('recipes/przepis.html.twig',['ingredients'=>$ingredients,'recipes'=>$recipes2,'tags'=>$tags,'comments'=>$comments,'form'=>$form->createView(),'form2'=>$form2->createView(),'form3'=>$form3->createView()]);

    }

    /**
     * @param Request $request
     * @return Response
     * @Route("przepisy/dwa/komentarz/form")
     */
    public function formAction(Request $request)
    {
        $task=new Task();
        $task->setTask('okej ');

        $form=$this->createFormBuilder($task)
            ->add('task',TextType::class)
            ->add('dodaj', SubmitType::class)
            ->getForm();
        return $this->render('recipes/przepis.html.twig',array('form'=>$form->createView(),));
    }

    // Dodawanie logowania
/*
    /**
     * @Route("/logowanie")
     */
/*
 *
    public function loginAction(Request $request)
    {
        $form=$this->createForm(LoginType::class);
        $form->handleRequest($request);
        return $this->render('recipes/logowanie.html.twig',array('form'=>$form->createView(),));
    }
*/
    /**
     * @Route("/rejestracja")
     */
    public function registrationAction(Request $request)
    {
        $user=new User();
        $form=$this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            /*
            $name=$form->get('name')->getData();
            $surname=$form->get('surname')->getData();
            $email=$form->get('email')->getData();
            $password=$form->get('password')->getData();
            $registration=$this->container->get('app.registration');
            $registration-> add_user($name,$surname,$email,$password);
          //  return $this->redirectToRoute('login');
*/
        }

        return $this->render('recipes/rejestracja.html.twig',array('form'=>$form->createView(),));
    }

    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page is ok!</body></html>');
    }
}

