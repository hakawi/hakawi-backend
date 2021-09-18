<?php

namespace App\Service\User;

use App\Entity\Collectible;
use App\Entity\Market;
use App\Entity\User;
use App\Entity\UserCollectible;
use App\Entity\UserMarket;
use App\Entity\UserMission;
use App\Repository\UserRepository;
use App\Service\Collectible\CollectibleService;
use App\Service\Market\MarketService;
use App\Service\Mission\MissionService;

class UserDashboardService
{
    protected $userRepo;
    private   $userService;
    private   $missionService;
    private   $collectibleService;
    private   $marketService;

    public function __construct(
        UserRepository $userRepository,
        UserService $userService,
        MissionService $missionService,
        CollectibleService $collectibleService,
        MarketService $marketService
    ) {
        $this->userRepo           = $userRepository;
        $this->userService        = $userService;
        $this->missionService     = $missionService;
        $this->collectibleService = $collectibleService;
        $this->marketService      = $marketService;
    }

    public function getByUid($uid)
    {
        $user = $this->userRepo->findOneBy(['uid' => $uid]);
        if (!$user instanceof User) {
            return [];
        }
        $data             = [];
        $data['point']    = $user->getPoint();
        $data['items']    = $user->getUserCollectibles();
        $data['missions'] = $user->getUserMissions();
        $data['markets']  = $user->getUserMarkets();

        return $this->mappingResponse($data);
    }

    public function mappingResponse($data)
    {
        return [
            'point'    => $data['point'],
            'items'    => $this->mappingItemsRes($data['items']),
            'missions' => $this->mappingMissionRes($data['missions']),
            'markets'  => $this->mappingMarketRes($data['markets']),
        ];
    }

    public function mappingItemsRes($items)
    {
        $returnData = [];

        foreach ($items as $item) {
            $itemFactory = [];
            dump($item);
            if ($item instanceof UserCollectible) {
                $itemCollectible = $item->getCollectible();
                $itemFactory  = [
                    'position' => $item->getPosition()
                ];
            } else if ($item instanceof Collectible) {
                $itemCollectible = $item;
            }

            if (isset($itemCollectible) && !empty($itemCollectible)) {
                $itemFactory  = [
                    'id'       => $itemCollectible->getId(),
                    'url'      => $itemCollectible->getUrl(),
                    'width'    => $itemCollectible->getWidth(),
                    'height'   => $itemCollectible->getHeight(),
                    'type'     => $itemCollectible->getType(),
                ];
            }

            if (!empty($itemFactory)) {
                $returnData[] = $itemFactory;
            }
        }

        return $returnData;
    }

    public function mappingMissionRes($missions)
    {
        $returnData = [];

        foreach ($missions as $mission) {
            if ($mission instanceof UserMission) {
                $userMission = $mission->getMission();
                $missionFactory = [
                    'id' => $userMission->getId(),
                    'title' => $userMission->getTitle(),
                    'description' => $userMission->getDescription(),
                    'order' => $userMission->getDefaultOrder(),
                    'collectible' => $this->mappingItemsRes($mission->getCollectible())
                ];
                $returnData[] = $missionFactory;
            }
        }

        return $returnData;
    }

    public function mappingMarketRes($markets)
    {
        $marketFactory = [];

        foreach ($markets as $market) {
            if ($market instanceof UserMarket) {
                $userMarket = $market->getMarket();
                $marketItem = $userMarket->getItem();
                $marketFactory[$userMarket->getCollection()] = [
                    'owner' => [
                        'uid' => $userMarket->getOwner()->getUid(),
                    ],
                    'item' => $this->mappingItemsRes($marketItem),
                    'price' => $userMarket->getPrice()
                ];
            }
        }

        return $marketFactory;
    }
}