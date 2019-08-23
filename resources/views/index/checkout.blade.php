@extends('layouts.top')
@section('title','前台主页')
@section('content')

<div class="checkout pages section">
		<div class="container">
			<div class="pages-head">
				<h3>CHECKOUT</h3>
			</div>
			<div class="checkout-content">
				<div class="row">
					<div class="col s12">
						<ul class="collapsible" data-collapsible="accordion">
							<li>
								<div class="collapsible-header"><h5>1 - 付款方式</h5></div>
								<div class="collapsible-body">
									<div class="payment-mode">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur provident repellat</p>
										<form action="{{url('index/pay')}}" class="checkout-radio">
												<div class="input-field">
													<input type="radio" class="with-gap" id="bank-transfer" name="group1">
													<label for="bank-transfer"><span>支付宝支付</span></label>
												</div>
												<div class="input-field">
													<input type="radio" class="with-gap" id="cash-on-delivery" name="group1">
													<label for="cash-on-delivery"><span>货到付款</span></label>
												</div>
												<div class="input-field">
													<input type="radio" class="with-gap" id="online-payments" name="group1">
													<label for="online-payments"><span>在线支付</span></label>
												</div>
                          <input type="submit"  class="btn button-default" value="支付">
											<!-- <a href="" class="btn button-default">支付</a> -->
										</form>
									</div>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><h5>2 - 订单核审</h5></div>
								<div class="collapsible-body">
									<div class="order-review">
										<div class="row">
											<div class="col s12">
											@foreach($data as $k=>$v)
												<div class="cart-details">
													<div class="col s5">
														<div class="cart-product">
															<h5>Image</h5>
														</div>
													</div>
													<div class="col s7">
														<div class="cart-product">
															<img src="{{$v->goods_big_pic}}" />
														</div>
													</div>
												</div>
												<div class="divider"></div>
												<div class="cart-details">
													<div class="col s5">
														<div class="cart-product">
															<h5>Name</h5>
														</div>
													</div>
													<div class="col s7">
														<div class="cart-product">
															<a href="">{{$v->goods_name}}</a>
														</div>
													</div>
												</div>
												<div class="divider"></div>
												<div class="cart-details">
													<div class="col s5">
														<div class="cart-product">
															<h5>单价</h5>
														</div>
													</div>
													<div class="col s7">
														<div class="cart-product">
															<span>¥{{$v->goods_markprice}}</span>
														</div>
													</div>
												</div>
											@endforeach
											</div>
										</div>
									</div>
									<div class="order-review final-price">
										<div class="row">
											<div class="col s12">
												<div class="cart-details">
													<div class="col s8">
														<div class="cart-product">
															<h5>小计</h5>
														</div>
													</div>
													<div class="col s4">
														<div class="cart-product">
															<span>$26.00</span>
														</div>
													</div>
												</div>
												<div class="cart-details">
													<div class="col s8">
														<div class="cart-product">
															<h5>运费:</h5>
														</div>
													</div>
													<div class="col s4">
														<div class="cart-product">
															<span>$5.00</span>
														</div>
													</div>
												</div>
												<div class="cart-details">
													<div class="col s8">
														<div class="cart-product">
															<h5>总</h5>
														</div>
													</div>
													<div class="col s4">
														<div class="cart-product">
															<span>¥<b id="price">{{$price}}</b></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<a href="/index/index" class="btn button-default button-fullwidth jiesuan">继续购买</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end checkout -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="/index/js/jquery.min.js"></script>
	<script>
     $('.jiesuan').click(function () {
          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          var price=$('#price').text();
          $.post(
              '/index/success',
              {price:price},
              function (res) {
                document.write(res);
              }
          )
     })
    </script>

@endsection
@section('bottom')