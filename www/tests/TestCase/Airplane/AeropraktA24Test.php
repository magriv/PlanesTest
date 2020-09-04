<?php

namespace Tests\TestCase\Airplace;

use App\Exception\FlyException;
use App\Exception\LandException;
use App\Exception\TakeoffException;
use App\Model\Airplane\AeropraktA24;
use App\Model\Airplane\AirplaneInterface;
use App\Model\Equipment\WeatherStationInterface;
use App\Model\State\StateFly;
use App\Model\State\StateLand;
use App\Model\State\StateTakeoff;
use App\Model\Surface\Water;
use PHPUnit\Framework\TestCase;

class AeropraktA24Test extends TestCase
{
    public function testTakeoffForbiddenByWeather(): void
    {
        $this->expectException(TakeoffException::class);

        $airplane = new AeropraktA24();
        $airplane->takeoff(new Water(), $this->createWeatherStationMock(false, true));
    }

    /**
     * @depends testTakeoffForbiddenByWeather
     */
    public function testTakeoffForbiddenByDatetime(): void
    {
        $this->expectException(TakeoffException::class);

        $airplane = new AeropraktA24();
        $airplane->takeoff(new Water(), $this->createWeatherStationMock(true, false));
    }

    public function testFlyBeforeTakeoff(): void
    {
        $this->expectException(FlyException::class);
        $this->expectErrorMessage('Should land');

        $airplane = new AeropraktA24();
        $airplane->fly();
    }

    public function testLandBeforeTakeoff(): void
    {
        $this->expectException(LandException::class);
        $this->expectErrorMessage('Already land');

        $airplane = new AeropraktA24();
        $airplane->land(new Water());
    }

    public function testTakeoffSuccess(): AirplaneInterface
    {
        $airplane = new AeropraktA24();
        $airplane->takeoff(new Water(), $this->createWeatherStationMock(true, true));

        self::assertInstanceOf(StateTakeoff::class, $airplane->getState());

        return $airplane;
    }

    /**
     * @depends testTakeoffSuccess
     */
    public function testLandBeforeFly(AirplaneInterface $airplane): void
    {
        $this->expectException(LandException::class);
        $this->expectErrorMessage('Should fly');

        $airplane->land(new Water());
    }

    /**
     * @depends testTakeoffSuccess
     */
    public function testTakeoffBeforeFly(AirplaneInterface $airplane): void
    {
        $this->expectException(TakeoffException::class);
        $this->expectErrorMessage('Already takeoff');

        $airplane->takeoff(new Water(), $this->createWeatherStationMock(true, true));
    }

    /**
     * @depends testTakeoffSuccess
     */
    public function testFlySuccess(AirplaneInterface $airplane): AirplaneInterface
    {
        $airplane->fly();

        self::assertInstanceOf(StateFly::class, $airplane->getState());

        return $airplane;
    }

    /**
     * @depends testFlySuccess
     */
    public function testTakeoffBeforeLand(AirplaneInterface $airplane): void
    {
        $this->expectException(TakeoffException::class);
        $this->expectErrorMessage('Should land');

        $airplane->takeoff(new Water(), $this->createWeatherStationMock(true, true));
    }

    /**
     * @depends testFlySuccess
     */
    public function testFlyBeforeLand(AirplaneInterface $airplane): void
    {
        $this->expectException(FlyException::class);
        $this->expectErrorMessage('Already fly');

        $airplane->fly();
    }

    /**
     * @depends testFlySuccess
     */
    public function testLandSuccess(AirplaneInterface $airplane): void
    {
        $airplane->land(new Water());

        self::assertInstanceOf(StateLand::class, $airplane->getState());
    }

    private function createWeatherStationMock(bool $isGoodWeather, bool $isDatetime)
    {
        $weatherStation = $this->createMock(WeatherStationInterface::class);
        $weatherStation
            ->method('isGoodWeather')
            ->willReturn($isGoodWeather);
        $weatherStation
            ->method('isDatetime')
            ->willReturn($isDatetime);

        return $weatherStation;
    }
}