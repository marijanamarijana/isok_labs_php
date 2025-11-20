<?php

enum Sector:string{
    case  TECHNOLOGY = "technology";
    case FINANCE = "finance";
    case HEALTHCARE = "healthcare";
    case ENERGY = "energy";
}

class StockPrice{
    public string $date;
    public float $closed_price;
    public float $opened_price;
    public float $highest_price;
    public float $lowest_price;

    public function __construct($date, $closed_price, $opened_price, $highest_price, $lowest_price)
    {
        $this->date = $date;
        $this->closed_price = $closed_price;
        $this->opened_price = $opened_price;
        $this->highest_price = $highest_price;
        $this->lowest_price = $lowest_price;
    }
}

class Stock{
    public string $ticker;
    public float $shares_outstanding;
    public Sector $sector;
    public array $stock_prices = [];

    public function __construct(string $ticker, float $shares_outstanding, Sector $sector)
    {
        $this->ticker = $ticker;
        $this->shares_outstanding = $shares_outstanding;
        $this->sector = $sector;
    }

    public function addStockPrice($stockPrice):void{
        if(!isset($this->stock_prices[$stockPrice->date])){
        $this->stock_prices[$stockPrice->date] = $stockPrice;
            }
        else{
            echo "There is already a historical price for this date for this stock\n"."<br>";
        }
    }

    public function calculateMarketCapForDate($date):float
    {
        if(!isset($this->stock_prices[$date])) {
        echo "No historical price for this date for this stock\n"."<br>";
        return 0;
        }
        return $this->stock_prices[$date]->closed_price * $this->shares_outstanding;
    }

    public function getClosedPrice(): ?float
    {
        $lastKey = array_key_last($this->stock_prices);

        if ($lastKey === null) {
            return null;
        }
        $lastStock = $this->stock_prices[$lastKey];

        if (!isset($lastStock->closed_price)) {
            return null;
        }

        return $lastStock->closed_price;
    }

}


class StockExchange{
    public string $exchange_name;
    public array $listed_stock = [];

    public function __construct(string $exchange_name)
    {
        $this->exchange_name = $exchange_name;
    }
    public function listStock($stock):void{
        $this->listed_stock[] = $stock;
    }
    public function findStockByTicker($ticker):?Stock
    {
        foreach ($this->listed_stock as $stock) {
            if ($stock->ticker === $ticker) {
                return $stock;
            }
        }
        echo "Stock not found\n"."<br>";
        return null;
    }
}

class Portfolio{
    public float $cash;
    public array $stockHoldings  = [];
    # ['numberOfShares' => број, 'stock' => објект од тип Stock]

    public function __construct(float $cash)
    {
        $this->cash = $cash;
    }
    public function buyStock($ticker, $numberOfShares, $stockExchange) : void
    {
        $stock = $stockExchange->findStockByTicker($ticker);
        if (!$stock) {
            echo "Stock not found\n"."<br>";
            return;
        }

        $price = $stock->getClosedPrice();
        if($price == null){
            echo  "No price available for this stock\n"."<br>";
            return;
        }

        $totalCost = $price * $numberOfShares;
        if ($totalCost > $this->cash) {
            echo "Insufficient cash to buy this stock\n"."<br>";
            return;
        }

        $added = false;

        foreach ($this->stockHoldings as $item) {
            if($item["stock"] == $stock){
                $item["numberOfShares"] += $numberOfShares;
                $added = true;
                return;
            }
        }

        if(!$added){
            $this->stockHoldings[] = [ "numberOfShares" => $numberOfShares, "stock" => $stock];
        }

        $this->cash -= $totalCost;
        echo "Bought $numberOfShares shares of $ticker for $totalCost USD on $stockExchange->exchange_name\n"."<br>";

    }
    public function sellStock($ticker, $numberOfShares, $stockExchange):void{

        $stock = $stockExchange->findStockByTicker($ticker);
        if (!$stock) {
            echo "Stock not found\n"."<br>";
            return;
        }

        $price = $stock->getClosedPrice();
        if($price == null){
            echo  "No price available for this stock\n"."<br>";
            return;
        }

        foreach ($this->stockHoldings as $item) {
            if($item["stock"] == $stock){
                if($item["numberOfShares"] < $numberOfShares){
                    echo "Not enough shares to sell\n"."<br>";
                    return;
                }

                $item["numberOfShares"] -= $numberOfShares;
                return;
            }
        }
        $totalCost = $price * $numberOfShares;
        $this->cash += $totalCost;

        echo "Sold $numberOfShares shares of $ticker for $totalCost USD on $stockExchange->exchange_name\n"."<br>";
    }
}


$applePrice1 = new StockPrice('01/01/2025', 100.0, 95.0, 102.0, 90.0);
$applePrice2 = new StockPrice('02/01/2025', 110.0, 100.0, 115.0, 98.0);
$applePrice3 = new StockPrice('03/01/2025', 120.0, 112.0, 125.0, 110.0);

$appleStock = new Stock('AAPL', 16000000000.0, Sector::TECHNOLOGY);
$appleStock->addStockPrice($applePrice1);
$appleStock->addStockPrice($applePrice2);
$appleStock->addStockPrice($applePrice3);

$microsoftStock = new Stock('MSFT', 7500000000.0, Sector::TECHNOLOGY);
$microsoftStock->addStockPrice(new StockPrice('01/01/2025', 300.0, 295.0, 310.0, 290.0));

$nasdaq = new StockExchange('NASDAQ');
$nasdaq->listStock($appleStock);
$nasdaq->listStock($microsoftStock);

echo "MarketCap 02/01/2025: ".($appleStock->calculateMarketCapForDate('02/01/2025') ?? 'null')." USD\n"."<br>";

$portfolio = new Portfolio(10000.0);
$portfolio->buyStock('AAPL', 10, $nasdaq);
$portfolio->buyStock('MSFT', 5, $nasdaq);
$portfolio->buyStock('MSFT', 1000, $nasdaq);
$portfolio->sellStock('AAPL', 4, $nasdaq);
$portfolio->sellStock('MSFT', 50, $nasdaq);

echo "Cash: {$portfolio->cash} USD\n"."<br>";
print_r($portfolio->stockHoldings);