<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Trades</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,600" rel="stylesheet" type="text/css">
	<link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div class="open-trades">
	<h2 class="text-center">Open trades</h2>
	<ul>
		<li class="list-header">
			<span>Symbol</span>
			<span>Invested</span>
			<span>Amount</span>
			<span>Price</span>
			<span>Date</span>
		</li>
		@foreach($openTrades as $open)
			@php
				$symbols = explode('/',$open->symbol);
				$boughtSymbol = $symbols[0];
				$investedSymbol = $symbols[1];
			@endphp
			<li>
				<span>{{$open->symbol}}</span>
				<span>{{$investedSymbol}} {{number_format($open->trade,4)}}</span>
				<span>{{$boughtSymbol}} {{number_format($open->amount,8)}}</span>
				<span>{{$investedSymbol}} {{number_format($open->price,2)}}</span>
				<span>{{$open->created_at}}</span>
			</li>
		@endforeach
	</ul>
</div>
<div class="position-ref full-height text-center">
	<h2>Closed trades:</h2>
	@foreach($buyTrades as $trade)
		<div class="container">
			<h2>{{$trade->symbol}}</h2>
			<div class="trade">
				<h3>BUY</h3>
				<p>Price: {{$trade->price}}</p>
				<p>Invested: {{$trade->trade}}</p>
				<p>Bought: {{$trade->amount}}</p>
				<p class="date">{{$trade->created_at}} | {{$trade->updated_at}}</p>
			</div>
			<div class="trade">
				<h3>TRAILING</h3>
				{{--<p>Percentage: {{$trade->trailing}}%</p>--}}
				{{--<p>Trailing Price: {{$trade->fix_sell}}</p>--}}
			</div>
			<div class="trade">
				<h3>SELL</h3>
				<p>Price: {{$sellTrades[$trade->order_id]['price']}}</p>
				<p>Profit: {{$sellTrades[$trade->order_id]['profit']}}</p>
				<p>Percentage: {{$sellTrades[$trade->order_id]['percentage']}}%</p>
				<p>SUM: {{$sellTrades[$trade->order_id]['amount']}}</p>
				<p class="date">{{$sellTrades[$trade->order_id]['created_at']}} | {{$sellTrades[$trade->order_id]['created_at']}}</p>
			</div>
		</div>
	@endforeach
</div>
</body>