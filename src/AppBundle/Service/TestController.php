<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 26.05.17
 * Time: 13:07
 */

namespace AppBundle\Service;




use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController
{
    private $logger;
    private $loggingEnabled;
    public function __construct(LoggerInterface $logger,$loggingEnabled)
    {
        $this->logger=$logger;
        $this->loggingEnabled=$loggingEnabled;
    }

    public function getHappyMessage()
    {
        if($this->loggingEnabled)
        {
            $this->logger->info('About to find a happy message!');
        }
         $messages=[
            'you did it! You update the system ! Amazing',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going',
        ];
        $index=array_rand($messages);
        return $messages[$index];
    }
}