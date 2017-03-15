<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Serializer\Normalizer\CategoryNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class ApiCategoryController
 * @package AppBundle\Controller
 * @Rest\Route(path="/api/categories")
 */
class ApiCategoryController extends Controller
{
    /**
     * @Rest\View
     * @Rest\Get("/")
     *
     * @ApiDoc(
 *      section="Categories",
     *  description="Returns a collection of Category object",
     *  filters={
     *  {"name"="a-filter", "dataType"="integer"},
     *  {"name"="another-filter", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"}
     *  }
     * )
     */
    public function getCategoriesAction()
    {
        return $this->getCategoryManager()->getCategories();
    }
    /**
     * @Rest\View
     * @Rest\Get("/{id}")
     *
     * @ApiDoc(
     *     section="Categories",
     *     description="Return a Category object",
     *     parameters={
     *       {"name"="id", "dataType"="integer", "required"=true, "description"="category id"}
     *    }
     * )
     */
    public function getCategoryAction(Category $category)
    {
        return $category;
    }

    private function getCategoryManager()
    {
        return $this->get('app.category_manager');
    }
}
