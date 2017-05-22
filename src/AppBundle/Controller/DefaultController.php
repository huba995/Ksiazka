<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ingredients;
use AppBundle\Entity\Recipes;
use AppBundle\Entity\Tags;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Comments;
use Symfony\Component\HttpFoundation\Response;

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
        $recipes=$em->getRepository('AppBundle:Recipes')->findAll();
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
    public function DishAction($param)
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

        return $this->render('recipes/przepis.html.twig',['ingredients'=>$ingredients,'recipes'=>$recipes2,'tags'=>$tags,'comments'=>$comments]);

    }

}
