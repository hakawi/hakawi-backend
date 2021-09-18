<?php

namespace App\Controller\Api;

use App\Repository\MarketRepository;
use App\Repository\UserMarketRepository;
use App\Service\Market\MarketService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MarketController extends AbstractApiController
{
    private $marketService;
    private $marketRepository;
    private $userMarketRepository;
    private $entityManager;

    public function __construct(
        MarketService $marketService,
        MarketRepository $marketRepository,
        UserMarketRepository $userMarketRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->marketService        = $marketService;
        $this->marketRepository     = $marketRepository;
        $this->userMarketRepository = $userMarketRepository;
        $this->entityManager        = $entityManager;
    }

    /**
     * @Route("/api/market/{id}", name="api_market", methods={"GET"})
     */
    public function index($id)
    {
        $marketItem = $this->marketRepository->find($id);

        if (empty($marketItem)) {
            return $this->jsonError('Not found');
        }

        return $this->jsonSuccess([
            'collection' => $marketItem->getCollection(),
            'price'      => $marketItem->getPrice(),
            'item'       => [
                'id'   => $marketItem->getItem()->getId(),
                'url'  => $marketItem->getItem()->getUrl(),
                'type' => $marketItem->getItem()->getType(),
            ],
            'owner'      => $marketItem->getOwner()->getUid(),
        ]);
    }

    /**
     * @Route("/api/market/sell", name="api_market", methods={"POST"})
     */
    public function sellItem(Request $request)
    {

    }

    /**
     * @Route("/api/market/buy", name="api_market", methods={"POST"})
     */
    public function buyItem(Request $request)
    {

    }
}
