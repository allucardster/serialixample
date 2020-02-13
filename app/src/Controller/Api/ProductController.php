<?php

namespace App\Controller\Api;

use App\Repository\ProductRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Rest\Route("/product")
 */
class ProductController extends AbstractFOSRestController
{
    /**
     * @var ProductRepository
     */
    private ProductRepository $repository;

    /**
     * ProductController constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Rest\Get("/")
     * @Rest\View(serializerGroups={"Default", "product_stock"})
     *
     * @return View
     */
    public function getAction(): View
    {
        $products = $this->repository->findAll();

        return View::create($products, Response ::HTTP_OK);
    }
}