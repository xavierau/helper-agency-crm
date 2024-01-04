@extends('layouts.default')

@section('content')
    <section class="container-fluid sub_banner"
             style="background: url({{$page->getContent('banner')}}) center center / cover no-repeat">
			<div class="row" style="background: rgba(0,0,0,0.6)">
				<div class="container">
					<div class="row m_t_90 m_b_90">
						 <div class="col-md-12 text-center">
						 	<h2>{{__('公司簡介')}}</h2>
						 </div>
					</div>
				</div>
			</div>
		</section>

    <section class="container-fluid">
			<div class="row">
				<div class="container">
					<div class="row m_t_50 m_b_50">
						<div class="col-md-10 col-md-offset-1">
							<div class="row">
								<div class="col-md-8 col-sm-6 col-xs-12">
									<div class="white_box">
										<div class="white_box_ribbion">
											{{__("精選推介")}}
										</div>

										<div class="sec_title">

                                            {!! $page->getContent('content') !!}

{{--                                            <h2 class="text-center">忠誠為你尋得好幫手 <br>  <span>家居雜務自然免憂愁</span></h2>--}}

{{--											<img src="/images/Groupm&w.png" class="img-responsive">--}}

{{--											<p>賴以顧客的信任, 忠誠菲、泰傭公司 已經營三十多載, 今後仍竭誠提供可靠,方便而妥善的服務予顧主。 本公司在菲律賓, 印尼, 孟加拉, 斯里蘭卡 等等國家均挑選純樸, 身心健康及有經驗女傭。 到港前, 接受家政訓練 ( 印尼, 孟加拉傭有粵語課程 )。</p>--}}
										</div>

									</div>
								</div>
								<div class="col-md-4  col-sm-6 col-xs-12">
									@include('_partials.featured_applicants')

                                    <a href="#" class="find_employee mobile_show"><img
                                            src="/images/find_employee.png"
                                            class="center-block"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection
