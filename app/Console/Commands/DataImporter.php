<?php

namespace App\Console\Commands;

use App\Models\Exchanges;
use App\Ticker;
use Illuminate\Console\Command;

class DataImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This imports data from exchanges.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $exchange = new \ccxt\poloniex (array (
            'verbose' => false,
            'timeout' => 30000,
        ));

        while(1) {
            try {

                $symbol = 'ETH/BTC';
                $result = $exchange->fetch_ticker($symbol);
                $exchangeId = Exchanges::where('slug', 'poloniex')->first()->id;

                $ticker = new Ticker();
                $ticker::updateOrCreate(
                    array(
                        'exchange_id' => $exchangeId,
                        'symbol' => $symbol,
                        'timestamp' => $result['timestamp'],
                        'datetime' => date('Y-m-d H:i:s', strtotime($result['datetime'])),
                        'high' => $result['high'],
                        'low' => $result['low'],
                        'bid' => $result['bid'],
                        'ask' => $result['ask'],
                        'vwap' => $result['vwap'],
                        'open' => $result['open'],
                        'close' => $result['close'],
                        'last' => $result['last'],
                        'change' => $result['change'],
                        'percentage' => $result['percentage'],
                        'average' => $result['average'],
                        'baseVolume' => $result['baseVolume'],
                        'quoteVolume' => $result['quoteVolume'],
                    )
                );

            } catch (\ccxt\NetworkError $e) {
                echo '[Network Error] ' . $e->getMessage () . "\n";
            } catch (\ccxt\ExchangeError $e) {
                echo '[Exchange Error] ' . $e->getMessage () . "\n";
            } catch (Exception $e) {
                echo '[Error] ' . $e->getMessage () . "\n";
            }
            sleep(5);
        } // while

    }
}
