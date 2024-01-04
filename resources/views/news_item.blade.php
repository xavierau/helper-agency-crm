@extends('layouts.default')

@section('content')

    <section class="container-fluid sub_banner"
             style="background: url(/images/banner.png) center center / cover no-repeat">
			<div class="row" style="background: rgba(0,0,0,0.6)">
				<div class="container">
					<div class="row m_t_90 m_b_90">
						 <div class="col-md-12 text-center">
						 	<h2>{{__("News")}}</h2>
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
								<div class="col-md-9 col-sm-8 col-xs-12">
									<div class="white_box">
										<div class="white_box_ribbion">
											{{__('News')}}
										</div>

										 <div class="blog_box details">
										 	{!! $news->getContent() !!}
										 </div>

									</div>

								</div>
								<div class="col-md-3  col-sm-4 col-xs-12 ">


										<div class="row image_section desktop_show">
											<div class="col-xs-12">
												<a href="images/placeholder.png"
                                                   data-lightbox="example-set"><img
                                                        src="/images/placeholder.png"
                                                        class="img-responsive"></a>
											</div>
											<div class="col-xs-12">
												<a href="images/placeholder.png"
                                                   data-lightbox="example-set"><img
                                                        src="/images/placeholder.png"
                                                        class="img-responsive"></a>
											</div>
											<div class="col-xs-12">
												<a href="images/placeholder.png"
                                                   data-lightbox="example-set"><img
                                                        src="/images/placeholder.png"
                                                        class="img-responsive"></a>
											</div>

										</div>



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


